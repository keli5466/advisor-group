<!--
The login dropdown button
-->

<template lang='pug'>

.login-dropdown(@click='getToggle'
	:class='[{toggled: toggled}, position]')
	.item Login
		.arrow
	transition(name='fade-down')
		.dropdown(v-if='dropdown'
			v-show='toggled' v-parse-anchors)
			a(:href='dropdown.advisor_login') I'm an Advisor
			a(href='/for-clients') I'm a Client

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['position', 'dropdown']

	data: -> toggled: false

	mounted: ->
		window.addEventListener 'scroll', @hideToggle

	watch:
		toggled: -> (@$clickOutside @$el, => @toggled = false) if @toggled

	methods:
		getToggle: ->	@toggled = !@toggled
		hideToggle: -> @toggled = false

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.login-dropdown
	font 'prox', 14px
	text-transform uppercase
	font-weight 600
	letter-spacing 1px
	border 1px solid rgba(white, 0.5)
	align-self center
	border-bottom none
	background transparent
	position relative
	width rem(190px)
	transition border 300ms ease-in-out
	@media (min-width S)
		&:hover
			cursor pointer

	// Here is the combined styles for the links so they are all uniform
	a:not(:last-of-type)
	.item
		&:after
			content ''
			position absolute
			border-bottom 1px solid rgba(white, 0.5)
			width 100%
			bottom 0
			left 50%
			transform translateX(-50%)
			transition width 300ms ease-in-out

	&.toggled
		a:not(:last-of-type):after
		.item:after
				width 90%

	.contact &
	.backgrounded &
		background white
		border-color rgba(silver, 0.5)
		a:hover
			background-color rgba(44, 48, 50, 0.1)

		a:not(:last-of-type):after
		.item:after
			border-color rgba(silver, 0.5)

// Shared positon and size styles
.item
a
	padding-h 5%
	position relative
	display flex
	align-items center
	height 34px
	.relative &
		height 50px

a
	transition background 300ms ease-in-out
	@media (min-width S)
		&:hover
			background-color rgba(44, 48, 50, 0.3)


.dropdown
	position absolute
	top 100%
	left -1px
	right -1px
	background transparent
	border 1px solid rgba(white, 0.5)
	border-top none

	.contact &
	.backgrounded &
		background white
		border-color silver

.desktop
	@media (max-width desktop)
		display none

// Arrow
.arrow
	margin-left auto
	transform rotate(0)
	border-top 6px solid white
	border-left 6px solid transparent
	border-right 6px solid transparent
	transition transform 300ms ease-in-out

	.contact &
	.backgrounded &
		border-top-color dark-grey

	.toggled &
		transform rotate(180deg)


// Made a prop to turn the positon on the drop down to relative so it can toggle open for mobile
.relative.login-dropdown
	border-bottom 1px solid silver
	.dropdown
		position relative
		top 0
		left 0
		right 0
		border none
	.item:after
		border-bottom-color transparent
	&.toggled
		a:after
		.item:after
			border-color silver

</style>
