<!--
The employee bio popup
-->

<template lang='pug'>

.bio.corner-card(:class='{open : open}')
	.wrapper
		h2 {{ name }}
		.job-title {{ jobTitle }}
		.description(v-html='description')

		.show-less(@click='close') Show Less

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['name', 'jobTitle', 'description']

	data: ->
		height: 100
		open: false

	# Measure the natural size of the elements, 1ms was needed before the bound
	# data (name, description) had dimensions in FF and IE
	mounted: ->
		delay = 1
		isIE = ! !navigator.userAgent.match(/Trident/g) or ! !navigator.userAgent.match(/MSIE/g)
		if isIE then delay = 50
		setTimeout =>
			@height = @$el.offsetHeight
			@$el.style.height = 0
			@$el.style.opacity = 0
			@animateOpen()
		, delay

	computed:
		# Make an accessor for Velocity which was set on the component by the
		# factory function in the parent.  I wanted to keep the $ prefix so usage
		# is similar to other places where the injected Nuxt plugin is used.
		$velocity: -> @velocity

	methods:
		close: ->
			@animateClose()
			@anchorDown()
			@removeClass()

		#removes expanded class
		removeClass:->
			@active = document.getElementsByClassName('expanded')
			i = 0
			while i < @active.length
				@active[i].classList.remove 'expanded'
				i++
			@removeTouched()

		# Adds opacity on cards not selected
		removeTouched: ->
			@touched = document.getElementsByClassName('touched')
			i = 0
			while i < @touched.length
				@touched[i].classList.remove 'touched'
				i++

		animateClose: ->
			@height = 0
			@open = false
			@$velocity @$el, {
				opacity: 0
				height: 0
			}, {
				duration: 300
			}

		anchorDown: ->
			target = document.querySelector '.expanded'
			block = document.querySelector '.employee-listing'
			@$velocity block, 'scroll', {
				offset: target.offsetTop - 70
			}, {
				duration: 300
			}

		animateOpen: ->
			@open = true

			if @open
				@$velocity @$el, {
					opacity: 0
					height: 0
				}, {
					duration: 300
					complete: @openWithDelay()
				}

			else
				@$velocity @$el, {
					opacity: 1
					height: @height
				}, 300

		openWithDelay: ->
			delay = 300
			setTimeout (=>
				@$velocity @$el, {
					opacity: 1
					height: @height
				}, 300
			), delay

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.bio
	width 100%
	height 100%
	background light-grey
	margin-right gutter-mobile

	@media (max-width tablet)
		margin-right 0
		
	&.open
		margin-bottom 20px


.wrapper
	padding rem(43px) rem(54px) rem(54px)
	display block

.job-title
	margin-top 8px
	font-weight normal
	bullet-copy()
	blockThemeColor color

h2
	wysiwyg-copy()

// Wraps text in two columns
.description
	bullet-copy()
	@media (min-width tablet)
		br
			line-height rem(50px)
		columns 100px 2
		column-gap rem(70px)
		margin rem(38px) 0 rem(18px)

.show-less
	cta-style()
	color grey
	cursor pointer
	&:hover
		&:after
			animation bounceright .3s alternate ease infinite
	&:after
		content '\00d7'
		font-size 25px
		font-weight 600
		margin-left 5px
		display inline-block
		vertical-align middle

// Tablet
@media (max-width tablet)
	.open
		margin-top -40px
		z-index 1
		height 100% !important //needed for mobile to override the fixed height
		.wrapper
			padding 0 rem(30px)
		h2
		.job-title
			display none
		.show-less
			text-align center
			margin-bottom 28px
		.description
			font-size 14px, true
			margin-top 0
			>>>
				p
					margin-bottom rem(38px)

</style>
