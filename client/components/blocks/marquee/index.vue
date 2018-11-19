<!--
The Marquee block
-->

<template lang='pug'>

.block.marquee(
	:class='[{home : home}, {scroll : scroll}]'
	ref='mq')

	.backgrounds(v-if='block.block_marquee_images')
		transition-group(name='slow-fade' tag='div')
			visual.background.kenburns(v-for='(background, index) in block.block_marquee_images'
				:key='index'
				:load='true'
				:image='background.imgs.background.l'
				v-show='index == currentSlide')

	.inner-max-w
		visual.eyebrow-image(v-if='block.imgs.marquee_eyebrow.l'
			background=''
			:load='true'
			:image='block.imgs.marquee_eyebrow.l')

		//- Wrapper class if eyebrow is present
		.copy
			.eyebrow(v-if='block.eyebrow') {{ block.eyebrow }}

			h1.headline {{ block.headline }}

			p.subhead(v-if='block.subhead') {{ block.subhead }}

			login-dropdown.marquee-dropdown(v-if='clients' position='relative')

			a.btn-fill(v-if='block.url'
				:class='block.button_type'
				:href='block.url') {{ block.cta }}

	firms(v-show='firms')

	.scroll-down(v-show='home' @click='scrollDown') SCROLL DOWN

	visual.float-logo(v-if='block.imgs.marquee_float_logo.l'
		:class='block.float_logo_position'
		background=''
		:image='block.imgs.marquee_float_logo.l')


	.sidebar(v-if='block.fields && block.hide_form != "1"')
			.callout(:class='{active : sidebar || sidebarBroker}')
				h4.broker(@click='sidebarBroker = true') Check Brokers on FINRA
				h4.form(@click='sidebar = true') Learn More About {{site}}
			transition(name='slide-right')
				.sidebar-container.form-container(
					ref='sidebarContainer'
					v-show='sidebar')
					.close(@click='sidebar = false')
					eloqua-form(v-if='block.fields'
						:successMessage='block.success'
						:fields='block.fields'
						type='sidebar')

			transition(name='slide-right')
				.sidebar-container.broker(
					ref='sidebarContainer'
					v-show='sidebarBroker')
					.broker-wrapper
						.close(@click='sidebarBroker = false')
						img(src='~/static/img/broker.png')
						p  To learn more about the professional history of our financial advisor(s), please visit FINRA’s BrokerCheck.
						a.outline-btn(href='https://brokercheck.finra.org/' target='_blank') Broker Check

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
import animateScrollTo from 'animated-scroll-to'
import { parseError, seo } from '~/utils/page'
export default

	props: ['block']
	components:
		'login-dropdown': require '~/components/global/login-dropdown'
		'firms': require '~/components/global/firms'
		'eloqua-form': require '~/components/global/eloqua-form'

	data: ->
		currentSlide: 0
		slider: null
		bgs: null
		home: null
		firms: null
		clients: null
		height: null
		scroll: false
		site: null
		sidebar: false
		sidebarBroker: false
		SBcontainer: @.$refs.sidebarContainer

	asyncData: ({ store }, block, extra) =>

		# Fetch form related data
		[ success, fields ] = await Promise.all [
			store.dispatch 'cache/get', 'layout/forms/success'
			store.dispatch 'cache/get', 'form/sidebar'
		]
		Vue.set block, 'success', success
		Vue.set block, 'fields', fields

	mounted: ->
		@setSideBar()
		@initSlider()
		@checkPage()
		@checkHeight()
		window.addEventListener 'resize', @checkHeight
		window.addEventListener 'scroll', @onScroll
		@onScroll()


	updated: -> @resetSlider()
	deactivated: -> @destroySlider()
	destroyed: -> @destroySlider()

	watch:
		SBcontainer: -> (@$clickOutside @$el, => @SBcontainer = false) if @SBcontainer

	methods:
		setSideBar: ->
			if process.env.SITE_SLUG == 'raa'
				@site = 'Royal Alliance'
			if process.env.SITE_SLUG == 'wfs'
				@site = 'Woodbury'
			if process.env.SITE_SLUG == 'spf'
				@site = 'SagePoint'
			if process.env.SITE_SLUG == 'fsc'
				@site = 'FSC'
			else if process.env.SITE_SLUG == 'ag'
				@site = process.env.SITE_SLUG

		scrollDown: ->
			animateScrollTo @$el.nextSibling, speed: 750, offset: -70

		# Fire the interval slider
		checkPage: ->
			if window.location.pathname == '/'
				@home = true

				if process.env.SITE_SLUG == 'ag'
					@firms = true

			else if @.$route.path == '/clients'
				@clients = true

			else
				@home = false
		# # sets height to what ever the height of the window is
		checkHeight: ->
			if @home == true
				@height = window.innerHeight - 50
				@$el?.style.height = @height + 'px'

		initSlider: ->
			if @block.block_marquee_images.length > 1
				@bgs = true
				@slider = setInterval ( =>
					if @currentSlide < @block.block_marquee_images.length - 1
						@currentSlide++
					else @currentSlide = 0
				), 4000

		# hide sidebar once scrolled down page
		onScroll: ->
			@st = window.pageYOffset or document.documentElement.scrollTop
			if @st > 75
				@sidebar = false
				@sidebarBroker = false
				@scroll = true
			else
				@scroll = false

		# Reset the interval and start fresh to avoid any problems on components
		# updating themselves
		resetSlider: ->
			clearInterval(@slider)
			@initSlider()

		# Destroy the'slider interval
		destroySlider: -> clearInterval(@slider)

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.marquee
	height 550px
	position relative
	display flex
	flex-direction column
	overflow hidden

	&:not(.home)
		.float-logo
			position absolute
			margin-top 10px
			bottom rem(30px)
			&.right
				right rem(35px)
				margin-left auto
			&.left
				left rem(35px)
		@media (min-width max-w)
			aspect-ratio(144/55)
			height auto
			display block
			.inner-max-w
				left 50%
				top 50%
				position  absolute
				transform translate(-50%,-50%)

	@media (max-width tablet)
		height 500px

// Float logo
.float-logo
	max-width rem(200px)
	position absolute
	bottom 30px
	@media (max-width mobile)
		max-width rem(100px)
	&.right
		right rem(40px)
	&.left
		left rem(40px)

.inner-max-w
	margin-v auto
	@media (max-width tablet)
		display flex
		flex-direction column
	@media (max-width mobile)
		margin-top 60px
		flex-grow 1
		margin-bottom 25px
	@media (min-width max-w)
		width 100% //IE

.backgrounds
	position absolute
	left 0
	top 0
	bottom 0
	right 0
	z-index -1
	background black //contrast QA request

.background
	position absolute
	top 0
	left 0
	height 100%
	width 100%

.inner-max-w
	position relative

.copy
	left-spacing()
	max-width rem(600px)
	@media (max-width mobile)
		margin-top auto
		width 100%

// BNTS & DROPDOWN
.marquee-dropdown
	margin-top rem(40px)
	width 210px
	button-style()

.btn-fill
	margin-top rem(40px)
	background-color rgba(255, 255, 255, 0.95)
	padding rem(18px) rem(30px) rem(20px)
	blockThemeColor color
	position relative
	display inline-block
	button-style()

	&.outline
		background transparent
		border silver 1px solid
		color white !important
		padding-top 8px
		padding-bottom 10px
		&:active
			border-color transparent
		&:before
			background-color rgba(255, 255, 255, 0.2)
	@media (max-width mobile)
		margin-top rem(20px)

	&:before
		background-color white
		position absolute
		top 0
		left 0
		right 0
		height 0
		z-index -1
		width 100%
		content ''
		transition all .25s ease
		background-position center top

	&:active
		transition background .25s ease, color .3s ease-in
		blockThemeColor background
		color white !important //needed to override blockThemeColor

	@media (min-width S)
		&:hover
				&:before
					height 100%
					transition all .25s ease

.eyebrow
	eyebrow-title()
	text-shadow h1shadow
	font-size 14px
	color white
	margin-bottom 10.5px

.headline
	headline()
	-webkit-text-stroke .5px
	text-shadow h1shadow

	@media (max-width mobile)
		margin-bottom rem(20px)
		font-size 38px, true
		.home &
			font-size 50px, true

.subhead
	body-copy()
	color white
	text-shadow h1shadow
	font-weight normal
	margin-top rem(39px)
	@media (max-width mobile)
		font-size 16px, true
		line-height 1.5
		margin-top rem(20px)

//  eyebrowPresent
.eyebrow-image
	max-width rem(310px)
	margin-bottom rem(35px)
	@media (max-width mobile)
		margin-bottom auto


// Scroll
.scroll-down
	font 'prox', 14px, white
	font-weight 900
	text-shadow h1shadow
	text-transform uppercase
	letter-spacing 2px
	line-height normal
	color white
	margin 0 auto
	text-align center
	margin-bottom 25px
	transition all ease-in 200ms
	&:hover
		cursor pointer
		letter-spacing 2.5px

	&:after
		display block
		margin-top rem(15px)
		content "\e902"
		font-family icomoon
		animation up-down 2s ease-in-out infinite

@keyframes up-down
	0%
		transform translateY(0)
	70%
		transform translateY(-10px)
	80%
		transform translateY(0)
	100%
		transform translateY(0)

>>>.firms
	width 60%
	margin-bottom rem(50px)
	@media (max-width tablet)
		display none!important


.sidebar
	z-index 9

	.scroll &
		z-index 9

	.callout
		position absolute
		right 0
		bottom 50%
		display flex
		transform-origin bottom right
		blockThemeColor background
		eyebrow-title()
		color white
		transform rotate(-90deg) translateX(50%)
		transition transform 300ms ease-in-out
		&.active
			transform rotate(-90deg) translateX(50%) translateY(50px)
		h4
			padding 10px 5%
			display inline-block
			width rem(200px)
			position relative
			text-align center
			&:hover
				cursor pointer
				&:before
					animation up-down-side 800ms ease-in-out forwards
			&:before
				content ''
				position absolute
				bottom 100%
				left 50%
				transform translateX(-50%)
				triangle(15px, 10px, light-grey, 'top')
		.form:before
			blockThemeColor border-bottom-color
		.form
			blockThemeColor background
		.broker
			blockThemeColor color
			background light-grey
	.home &
		h4
			width rem(280px)
	h4.form
	.form-container
		@media (max-width tablet)
			display  none

@keyframes up-down-side
	0%
		transform translateY(0px) translateX(-50%)
	25%
		transform translateY(5px) translateX(-50%)
	50%
		transform translateY(0px) translateX(-50%)
	75%
		transform translateY(5px) translateX(-50%)
	100%
		transform translateY(0px) translateX(-50%)

.sidebar-container
	position fixed//needed for the different heights of forms
	right 0
	top 50%
	transform translateY(-50%)
	background light-grey
	max-width 400px
	margin-left auto
	padding rem(14px) rem(23px) rem(20px)
	z-index 11

.broker-wrapper
	display flex
	flex-direction column
	justify-content center
	text-align center
	margin-h rem(20px)
	width 250px
	img
		width 70%
		height 100%
		margin-h auto
	p
		margin-bottom rem(30px)
		margin-top rem(5px)
		line-height 1.45
		font-size rem(20px)
		text-align center
	.outline-btn
		blockThemeColor color

.close
	cursor pointer
	width rem(13px)
	margin-left auto
	z-index 2
	&:after
		content '\00d7' //unicode X
		font-family sans-serif
		font-weight 300
		font-size rem(30px)
		line-height 30px

//
// .marquee
// 	.backgrounds
// 		transition opacity 300ms ease-out
//
// 	.sidebar
// 		transition opacity 300ms 500ms ease-out, transform 300ms 500ms ease-out
//
// 	.eyebrow-image
// 		transition opacity 300ms 200ms ease-out, transform 300ms 200ms ease-out
//
// 	.eyebrow
// 		transition opacity 300ms 300ms ease-out, transform 300ms 300ms ease-out
//
// 	.headline
// 		transition opacity 300ms 400ms ease-out, transform 300ms 400ms ease-out
//
// 	.subhead
// 		transition opacity 300ms 500ms ease-out, transform 300ms 500ms ease-out
//
// 	.marquee-dropdown
// 		transition opacity 300ms 600ms ease-out, transform 300ms 600ms ease-out
//
// 	.btn-fill
// 		transition opacity 300ms 700ms ease-out, transform 300ms 700ms ease-out
//
// 	.scroll-down
// 		transition opacity 300ms 800ms ease-out, transform 300ms 800ms ease-out
//
// .marquee:not(.in-viewport)
// 	.backgrounds
// 		opacity 0
//
// 	.sidebar
// 		opacity 0
// 		transform translateX(100%)
//
// 	.eyebrow-image
// 		opacity 0
// 		transform translateX(-50px)
//
// 	.eyebrow
// 		opacity 0
// 		transform translateX(-50px)
//
// 	.headline
// 		opacity 0
// 		transform scale(1.1)
//
// 	.subhead
// 		opacity 0
// 		transform scale(1.1)
//
// 	.marquee-dropdown
// 		opacity 0
// 		transform translateY(75px)
//
// 	.btn-fill
// 		opacity 0
// 		transform translateY(75px)
//
// 	.scroll-down
// 		opacity 0
// 		transform translateY(75px)

</style>
