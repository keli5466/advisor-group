<!--
The mobile navigation
-->

<template lang='pug'>

transition(name='slide-in')
	.mobile-nav(:class='{open: open}')

		.hamburger(v-on:click='onClick'
			:class='{open: open}')
			.line
			.line
			.line

		.menu
			.logo(@click='onClick')
				brand-logo

			.links(v-if='nav' v-parse-anchors)
				template(v-for='(root, index) in nav.nav_root_links')

					a.root-link(
						@click='onClick'
						:href='root.url'
						:class="{'active': root.url === $route.path}") {{ root.title }}

					.sub-menu(v-if='root.navChildLinks.length')

						a.child-link(v-for='child in root.navChildLinks'
							@click='onClick'
							:href='child.url'
							:class="{'active': child.url === $route.path}") {{ child.title }}

			login-dropdown.mobile(:dropdown='dropdown'
				position='relative')

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['nav', 'dropdown']

	data: ->
		open: false

	components:
		'brand-logo': require '~/components/global/brand-logo'
		'login-dropdown': require '~/components/global/login-dropdown'
		dropdown: require './dropdown'

	mounted: -> @body = document.body

	methods:
		onClick: ->
			if @open == false
				@open = true
				@body.style.overflow ='hidden'

			else
				@open = false
				@body.style.overflow =''

			this.$emit('toggle', @open)


</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.mobile-nav
	display block
	position fixed
	top 0
	right 0
	height 100%
	width 85%
	max-width 600px
	background white
	transform translateX(100%)
	transition transform 300ms ease-in-out

	@media (min-width desktop + 1)
		display none

	&.open
		transform translateX(0%)
		height auto
		max-height 100%
		-webkit-overflow-scrolling touch
		overflow-y scroll

		.child-link.active
			sitePrimaryThemeColor color

.hamburger
	position absolute
	top 30px
	transform translateX(-100% - 80px)
	z-index header-z + 10
	width 20px

	&.open
		right 0
		.line
			background dark-grey

		.line:nth-child(1)
			transform rotate(45deg) translate(6px, 6px) !important

		.line:nth-child(2)
			opacity 0

		.line:nth-child(3)
			transform rotate(-45deg) translate(5px, -5px) !important


	.contact &
	.backgrounded &
		.line
			background dark-grey

	.line
		width 20px
		background white
		height 2px
		transition transform 300ms ease-in-out
		&:not(:last-of-type)
			margin-bottom 6px

.menu
	width 100%
	height @width
	padding rem(40px)
	display flex
	flex-direction column

.brand-logo
	color dark-grey
	font-size 75px

.links
	display flex
	flex-direction column
	flex-wrap wrap
	margin-top auto
	padding 10px 0

.root-link
	display block
	font 'regular',40px, dark-grey
	line-height 1
	font-weight 300
	&:not(:first-of-type)
		margin-top rem(33px)

	&.active
		sitePrimaryThemeColor color
		width fit-content

.sub-menu
	font-size rem(30px)
	margin-top rem(10px)
	margin-left 5%
	color lighten(dark-grey,35%)
	max-width 100%
	a
		margin-top 10px
		display block

.login-dropdown.mobile
	display block
	color dark-grey
	border-color silver
	width 100%
	font-size 20px
	margin-top auto
	>>>
		.arrow
			border-top-color dark-grey


</style>
