<!--
The diagonal slash component
-->

<template lang='pug'>

.slash(
	:class='direction'
	v-in-viewport.once
	:style='styleObject')
	.line(:style='animation')


</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props:
		direction: default: null
		left: default: 'initial'
		right:  default: 'initial'
		delay: default: '500ms'


	data: ->
		styleObject: null
		lineHeight: null
		animation: null
		# transition-duration: null
	mounted: ->
		parent = @$el.parentNode
		@styleObject =
			left: @left
			right: @right
			height: "#{parent.offsetHeight * 3.5}px"
		@lineHeight = "#{parent.offsetHeight * 3.5}px"
		@animation =
			'animation-duration': "#{parent.offsetHeight / 100}s"
			'animation-delay': @delay

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>
.slash
	position absolute
	transform rotate(45deg)
	&.down
		transform rotate(-45deg)
	&.in-viewport
		.line
			animation dash ease forwards

		
.line
	background silver
	width 1px
	height 0
	
@keyframes dash 
	to 
		height 100%	
	

.slash
	width 1px
	z-index -1
	position absolute
	left 0
	top 50%
	transform-origin top center
	transform rotate(45deg) translate(-50%, -50%)

	&.down
		transform rotate(-45deg) translate(-50%, -50%)
		left initial
		right 0

</style>
