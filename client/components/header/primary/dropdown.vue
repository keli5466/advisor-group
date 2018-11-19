<!--
The nav dropdown component
-->

<template lang='pug'>

.dropdown(
	@mouseenter='open = true'
	@mouseleave='open = false')

	.link: slot(name='link')

	transition(name='fade')
		.menu(v-show='open' v-if='childLinks.length')
			template(v-for='child in childLinks')
				a.child-link(:href='child.url'
					v-on:click="$emit('route-change')") {{ child.title }}

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['childLinks']
	data: ->
		open: false

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.dropdown
	position relative
	height 100%
	line-height nav-height

.menu
	background white
	position absolute
	top calc(100% + 5px)
	left 0
	width auto
	min-width 130%
	line-height 1
	border-top 1px solid offwhite

.child-link
	display block
	text-transform uppercase
	font 'prox', 13px, grey
	font-weight 600
	letter-spacing 1.3px
	margin rem(17px) rem(20px)

	&:not(:last-of-type)
		border-bottom 1px solid offwhite
		padding-bottom rem(17px)

</style>
