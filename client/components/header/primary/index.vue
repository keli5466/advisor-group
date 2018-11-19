<!--
The public site header layout
-->

<template lang='pug'>

header.primary(:class='[{backgrounded: backgrounded },{hide: mobileHide},{contact: contactPage},{contact: gatedPage}]'): .max-w
	brand-logo.main(:isHome='homePage')
	primary-nav(:nav='nav'
		v-on:route-change='findAnchor')
	mobile-nav(:nav='nav'
		:dropdown='dropdown'
		v-on:toggle='mobileToggle')
	login-dropdown.desktop(:dropdown='dropdown')

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default

	components:
		'brand-logo': require '~/components/global/brand-logo'
		'primary-nav': require './primary-nav'
		'mobile-nav': require './mobile-nav'
		'login-dropdown': require '~/components/global/login-dropdown'

	data: ->
		mobileHide: false
		backgrounded: false
		st: 0
		nav: null
		dropdown: null

	mounted: ->
		@dropdown = await @$store.dispatch 'cache/get', 'layout/main_dropdown'
		@nav = await @$store.dispatch 'cache/get', 'nav/primary-menu'

		window.addEventListener 'scroll', @onScroll
		@onScroll()
		@findAnchor()


	computed:
		# If we are on the home page we need to hide the logo until we scroll
		homePage: -> this.$route.fullPath == '/'
		# If we are on the contact page the header is always present
		contactPage: -> this.$route.fullPath == '/contact'
		
		gatedPage: -> @$store.state.layout.backgroundedHeader

	methods:

		# Emitted from mobile nav
		mobileToggle: (hide) ->
			@mobileHide = hide ? true : false
			# @backgrounded = false
			if @mobileHide == false then @revealHeader()

		# Show the header after the mobile nav closes
		revealHeader: ->
			if @st > 150
				@backgrounded = true

		# Background for header on scroll
		onScroll: ->
			@st = window.pageYOffset or document.documentElement.scrollTop
			if @st > 150
				@backgrounded = true
			else
				@backgrounded = false

		# Find if there is a hash in the url
		findAnchor: ->
			setTimeout ( =>
				anchor = window.location.hash.substring(1)
				destination = document.querySelector('[data-anchor="'+anchor+'"]')

				if destination
					@jump(destination)
			), 500

		# Jump to the target destination
		jump: (destination) ->
			window.scroll
				top: 2500
				left: 0
				behavior: 'smooth'


</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>
.primary
	position fixed
	top 0
	left 0
	right 0
	height nav-height
	z-index header-z
	color white
	transition background 300ms ease-in-out,
						 color 300ms ease-in-out

	&.contact
	&.backgrounded
		background white
		color dark-grey
		border-bottom 1px solid offwhite

	&.hide
		background transparent
		border-bottom-color transparent

		.brand-logo.main
			opacity 0

.brand-logo
	font-size 50px
	line-height nav-height

.max-w
	width 100%
	height 100%
	display flex
	justify-content space-between
	padding-left: 3.125rem;
	padding-right: 3.125rem;

	@media (max-width wide-break)
		padding-left rem(50px)
		padding-right @padding-left

</style>
