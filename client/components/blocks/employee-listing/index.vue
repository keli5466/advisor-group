<!--
The Employee Listing Block
-->
<template lang='pug'>

.block.employee-listing.slide-in(
	data-anchor='block.slug'
	v-in-viewport.once)
	.image
		visual.bkgd(v-if='block.imgs.employee_listing_background.l'
			:load='true'
			:image='block.imgs.employee_listing_background.l')

	.top-slide.block-v-pad
		.content(v-in-viewport.once
			ref='list')
			.employee.corner-card(v-if='block.employees'
				v-for='(employee, index) in block.employees'
				ref='employees')
				template(v-if='employee.name')
					visual.headshot.grow(v-if='employee.imgs.listing.l'
						:image='employee.imgs.listing.l'
						:load='true'
						aspect='1')
					.close(@click='remove()')
					.wrapper
						.name {{ employee.name }}
						.job-title {{ employee.job_title }}

						.more(@click='openBio($event, index)'
							:data-name='employee.name'
							:data-title='employee.job_title'
							:data-description='employee.description') Show More

			nuxt-link.btn(v-if='block.cta'
				:to='block.url') {{ block.cta }}

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
Bio = Vue.extend require '~/components/blocks/employee-listing/bio'
export default
	props: ['block']

	data: ->
		component: null
		show: false

	methods:

		# Make a bio component and hydrate it with plugins
		makeBio: ->
			bio = new Bio
			bio.velocity = @$velocity
			bio.$mount()
			return bio

		openBio: (e, index) ->
			self = e.currentTarget
			@addClass(index)

			if @component
				@component.animateClose()
				setTimeout (=>
					@component.$destroy()
					@component = null
					toRemove = document.querySelector('.bio')
					toRemove.parentNode.removeChild(toRemove)

					@component = @makeBio()
					@component.$props.name = self.dataset.name
					@component.$props.description = self.dataset.description
					@component.$props.jobTitle = self.dataset.title
					@mountComponent(index)
				), 300

			else
				@component = @makeBio()
				@component.$props.name = self.dataset.name
				@component.$props.description = self.dataset.description
				@component.$props.jobTitle = self.dataset.title

				@mountComponent(index)

		remove: ->
			@component.close()

		# This lets you click show more on another employee to close the current
		addClass: (index) ->
			# removes if the class was previous clicked
			@.$refs.list.classList.add('touched')
			@active = document.getElementsByClassName('expanded')
			i = 0
			while i < @active.length
				@active[i].classList.remove 'expanded'
				i++
			# Adds to index
			@.$refs.employees[index].classList.add('expanded')

		mountComponent: (index) ->
			offset = @checkViewportWidth(index)

			if @.$refs.employees.length <= offset
				offset = @.$refs.employees.length - 1

			beforeSlot = @.$refs.employees[offset]
			@insertAfter(@component.$el, beforeSlot)

		checkViewportWidth: (index) ->
			if (document.body.offsetWidth >= 768)
				return @roundTo(index + 1, 3) - 1
			else
				return @roundTo(index + 1, 1) - 1

		# Round the index to the nearest divisor
		roundTo: (index, divisor) ->
			if (index > 0)
				return Math.ceil(index/divisor) * divisor
			else if (index < 0)
				return Math.floor(index/divisor) * divisor
			else
				return divisor

		insertAfter: (newNode, referenceNode) ->
			referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling)

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.employee-listing
	display flex
	width 100%
	overflow-x hidden
	position relative
	top-slide-in('left', gutter-wide)
	@media (min-width max-w)
		.top-slide
			margin-left 'calc(50vw - %s / 2)' % (inner-max-w)

.image
	@media (min-width XL-max)
		width 'calc(50vw - %s / 2)' % (inner-max-w) !important

.top-slide
	background white

.content
	max-width inner-max-w
	left-spacing()
	display flex
	align-items stretch
	flex-wrap wrap

	@media (max-width mobile)
		padding gutter


// IMAGE STYLES
.image
	display flex
	@media (max-width mobile)
		display none

	@media (min-width S)
		position absolute
		top 0
		bottom 0
		z-index -1

.bkgd
	width 100%
	height 100%

.employee
	position relative
	width 'calc(100%/3 - %s)' % gutter-mobile
	margin-right gutter-mobile
	padding rem(27px) 5%
	background-color light-grey
	text-align center
	margin-bottom 20px
	display flex
	flex-direction column

	@media (max-width tablet)
		width 100%
		flex-direction row
		text-align left
		margin-right 0

	&.hidden
		opacity 0

.wrapper
	display flex
	max-width 225px
	margin-h auto
	flex-grow 1
	flex-direction column
	@media (max-width tablet)
		margin-left 18px
		margin-top 0

.headshot
	border-radius 50%
	overflow hidden
	width 100%
	max-width calc(147px)
	max-height @max-width
	flex-shrink 0
	margin 0 auto rem(21px)
	@media (max-width mobile)
		height 80px
		width @height


.name
	wysiwyg-copy()

.job-title
	bullet-copy()
	blockThemeColor color
	margin rem(23px) auto rem(30px)
	@media (max-width mobile)
		margin 2px auto 18px
		font-size 14px, true
		letter-spacing normal
		line-height 1.36


.more
	margin-top auto
	cta-style()
	color grey
	cursor pointer
	&:hover
		&:after
			animation bounceright .3s alternate ease infinite
	&:after
		content '+'
		font-size 20px
		font-weight 600
		margin-left 5px
		display inline-block
		vertical-align middle
		padding-bottom 1px



.btn
	button-style()
	blockThemeColor background
	max-width rem(380px)
	width 32%
	margin 0 auto
	display block
	text-align center
	margin-top 74px
	@media (max-width desktop)
		width 100%

	&:before
		content '<'
		font-size 20px
		font-weight 600
		margin-right 15px
		display inline-block
		vertical-align middle



// image grow animation
@media (min-width tablet)
	.wrapper
		margin-top calc(147px + 21px) //image width + margin to space the image
	.grow
		position absolute
		border-radius 100%
		transform scale(0.8) translateZ(0)
		z-index 1
		max-width calc(147px/0.8) //multple the scale
		max-height @max-width
		left 0
		right 0
		will-change transform
		top 0
		transition all 200ms easeOutQuart
	.expanded
		// just a placeholder this will be the active state
		.grow
			transition all 300ms easeOutQuart 300ms
			transform scale(1) translateZ(0)
			border-radius 0
			height calc(100% + 0.625rem + 20px)
			width calc(100% + 0.625rem)
			max-width @width
			max-height @height
		.close
			opacity 1
			transition .2s
			&:hover
				animation none
				transform scale(1.4)

@media (max-width tablet)
	.expanded
		margin-bottom 0
		.more
			opacity 0
			pointer-events none


.close
	width rem(20px)
	height @width
	right 5px
	opacity 0
	z-index 2
	color white
	top 5px
	position absolute
	&:hover
		cursor pointer
	&:after
		content '\00d7' //unicode X
		font-family sans-serif
		font-weight 300
		font-size rem(30px)
		line-height 30px


.touched
	.employee
		opacity 1
		transition opacity .3s ease
		&:not(.expanded)
			opacity 0.4

.hidden
	opacity 0
	pointer-events none
	visibility hidden


.content
	-webkit-backface-visibility hidden
	.employee
		transform translateY(50px)

	for i in (1..20)
		> div:nth-child({i})
			opacity 0
			transition transform 600ms cubic-bezier(0, 0, 0.2, 1), opacity 1s ease
			transition-delay 900ms + (i*120)

	&.in-viewport
		.employee
				transform translateY(0%)
				opacity 1



</style>
