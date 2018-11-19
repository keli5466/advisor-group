<!--
The map block
-->

<template lang='pug'>

.block.location-map.slide-in( :data-anchor='block.slug')
	.image
		.map#map
	.top-slide.block-v-pad
		.content(v-in-viewport.once)
			diagonal-slash(direction='' left='30%')
			.copy-wysiwyg.fade-in(v-in-viewport.once)
				.eyebrow(v-if='block.headline') {{ block.headline }}
				.wysiwyg(v-if='block.copy' v-html='block.copy')

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
mapsApiLoaded = false
export default
	props: ['block']

	components:
		'diagonal-slash': require '~/components/global/diagonal-slash'

	data: -> pins: null

	mounted: ->
		window.initMap = @initMap if window?
		@loadGoogleScript()

	methods:

		# Add the script tag
		loadGoogleScript: ->
			
			# Only do once
			return if mapsApiLoaded
			mapsApiLoaded = true
			
			# Write script tag
			script = document.createElement 'script'
			script.src = "https://maps.googleapis.com/maps/api/js\
				?key=#{process.env.GOOGLE_MAPS_KEY}\
				&callback=initMap"
			document.head.appendChild script

		initMap: ->
			# Get all the pins
			@pins = @block.locations

			# Set the intial center lat and lng based on the first pin location
			centerLat = @pins[0].latitude
			centerLng = @pins[0].longitude

			bounds = new google.maps.LatLngBounds()

			# Create the map with default center and zoom position
			map = new (google.maps.Map)(document.getElementById('map'),
				center:
					lat: Number(centerLat)
					lng: Number(centerLng)
				zoom: 16
				disableDefaultUI: true
				styles: [
					{elementType: 'geometry', stylers: [{color: '#eeeeee'}]}
					{elementType: 'labels.text.stroke', stylers: [{color: '#ffffff'}]}
					{elementType: 'labels.text.fill', stylers: [{color: '#7c878e'}]}
					{featureType: 'road.highway',elementType: "labels",stylers:[{visibility: "off"}]}
					{featureType: 'road.arterial',elementType: "labels",stylers: [{visibility: "off"}]}
					{featureType: 'road.local',elementType: "labels",stylers: [{visibility: "off"}]}
					{
						featureType: 'administrative.locality'
						elementType: 'labels.text.fill'
						stylers: [ { color: '#7c878e' } ]
					}
					{
						featureType: 'road'
						elementType: 'geometry'
						stylers: [ { color: '#ffffff' } ]
					}
					{
						featureType: 'road'
						elementType: 'labels.text.fill'
						stylers: [ { color: '#7c878e' } ]
					}
					{
						featureType: 'road'
						elementType: 'geometry.stroke'
						stylers: [{color: '#ffffff'}]
					}
					{
						featureType: 'road.highway'
						elementType: 'geometry'
						stylers: [ { color: '#ffffff' } ]
					}
					{
						featureType: 'road.highway'
						elementType: 'labels.text.fill'
						stylers: [ { color: '#7c878e' } ]
					}
					{
						featureType: 'road.highway'
						elementType: 'geometry.stroke'
						stylers: [{color: '#ffffff'}]
					}
					{
						featureType: 'transit'
						elementType: 'geometry'
						stylers: [ { color: '#fafafa' } ]
					}
					{
						featureType: 'transit.station'
						elementType: 'labels.text.fill'
						stylers: [ { color: '#7c878e' } ]
					}
					{
						featureType: 'water'
						elementType: 'geometry'
						stylers: [ { color: '#EDEDED' } ]
					}
					{
						featureType: 'water'
						elementType: 'labels.text.fill'
						stylers: [ { color: '#7c878e' } ]
					}
					{
						featureType: 'landscape.natural'
						elementType: 'geometry'
						stylers: [ { color: '#E5E5E5' } ]
					}
					{
						featureType: 'poi',
						stylers: [
							{ visibility: "off" }
						]
					}
				])

			@setPins(map, bounds)

			# Only resize the bounds if there is more than one pin
			if @pins.length > 1
				map.fitBounds(bounds)

		# Add a marker to the map for each pin
		setPins: (map, bounds) ->
			# Create the new bounds and info window
			infoWindow = new google.maps.InfoWindow()

			@pins.forEach (el, i) ->
				if el.home == '1'
					iconHome =
						url: './img/'+process.env.SITE_SLUG+'-logo.png'
						scaledSize: new (google.maps.Size)(50,50)
					# Gives home marker its on marker with higer index
					marker = new (google.maps.Marker)(
						position: new (google.maps.LatLng)(Number(el.latitude), Number(el.longitude))
						map: map
						titl: el.name
						zIndex: 10
						optimized: false
						icon: iconHome)
				else
					icon =
						url: './img/'+process.env.SITE_SLUG+'.png'
						scaledSize: new (google.maps.Size)(20, 25)

					marker = new (google.maps.Marker)(
						position: new (google.maps.LatLng)(Number(el.latitude), Number(el.longitude))
						map: map
						titl: el.name
						zIndex: 1
						optimized: false
						icon: icon)
					
				# Extend the bounds to include the marker
				bounds.extend(marker.position)

				# Create the content for each info window
				contentString = '<div class="info-content">' +
					'<div class="info-name">' + el.name + '</div>' +
					'<div class="info-address">' + el.description + '</div>' +
					'</div>'

				# Set a listener on each pin for the info winder
				google.maps.event.addListener marker, 'click', do (marker, i) ->
					->
						infoWindow.setContent contentString
						infoWindow.open map, marker

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>


.block
	display flex
	width 100%
	height 100%
	overflow-x hidden
	position relative
	top-slide-in('left', half-width)
	.image
		width 45vw
	@media (max-width tablet)
		flex-direction column-reverse

		.image
			width 100%
			display block
			position relative
		.content
			margin-h(auto)

		.top-slide
			padding-h(gutter-mobile)
			margin auto


.top-slide
	background white
	width 100%
	overflow hidden
	transform translateX(0)!important


.map
	aspect-ratio(1)
	width 100%

.content
	left-spacing()
	max-width rem(600px)
	@media (min-width max-w)
		padding-left 20px

.copy-wysiwyg
	background white
// Info -Window / tooltip
>>>
	.gm-style-iw
		padding 16px 5%
		text-align center
	.info-content
		text-align center
	.info-name
		font 'regular', 22px, dark-grey
		font-weight 300
		line-height 1.45
		margin-bottom 6px
	.info-address
		bullet-copy()

	.gmnoprint
		display none

	img[src*='-logo']
		z-index 100!important
		div &
			z-index 100!important

</style>
