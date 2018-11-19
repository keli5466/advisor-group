<!--
The primary nav
-->

<template lang='pug'>

.primary-nav(v-if='nav' v-parse-anchors)
	.root-link(v-for='root in nav.nav_root_links')

		//- Dropdown with child links
		dropdown(:childLinks='root.navChildLinks')
			a.link(slot='link'
				:href='root.url'
				v-on:click="$emit('route-change')") {{ root.title }}

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['nav']

	components:
		dropdown: require './dropdown'

	methods:

		changeRoute: ->
			this.$emit('route-change')

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.primary-nav
	display flex
	align-items center
	justify-content center
	height 100%
	width 70%
	margin 0 auto

	@media (max-width desktop)
		display none

.root-link
	cursor pointer
	position relative
	display flex
	flex-direction column
	justify-content center
	margin 0 rem(16px) -1px
	height 100%
	border-bottom 5px solid transparent
	transition border-bottom 400ms ease-in-out
	@media (max-width desktop)
		margin 0 auto

	&:hover
		border-bottom 5px solid
		sitePrimaryThemeColor border-color



.link
	text-transform uppercase
	font 'prox', 14px
	letter-spacing 1px
	font-weight 600
	height 100%
	line-height nav-height
	border-bottom 5px solid transparent
	transition border-bottom 400ms ease-in-out

</style>
