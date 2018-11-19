<!--
The Copy and Image Block
-->

<template lang='pug'>
.block.copy-and-image(v-in-viewport.once
	:data-anchor='block.slug'
	:class='[ block.layout, block.image_width, block.theme, {activate: move}]')

	.image(:class='{ foreground: block.imgs.copy_and_image_foreground.l}')
		visual.bkgd(v-if='block.imgs.copy_and_image_background.l'
			:load='true'
			aspect='1:1'
			:image='block.imgs.copy_and_image_background.l')
		visual.foreground-image(v-if='block.imgs.copy_and_image_foreground.l'
			background=''
			:load='true'
			:image='block.imgs.copy_and_image_foreground.l')


	video-modal(v-if='block.video' :video='block.video' :direction='block.layout' :active='videoactive' :data-video='block.video' ref='video')

	//- .copy-wysiwyg add styles for headline and wysiwyg
	.top-slide.block-v-pad
		.content(v-in-viewport.once).copy-wysiwyg
			diagonal-slash(v-if='block.layout == "image-left"' direction='down' right='30%')
			diagonal-slash(v-else='block.layout == "image-right"' direction='' left='30%')
			.content-wrapper(v-in-viewport.once)
				.eyebrow(v-if='block.headline') {{ block.headline }}
				.wysiwyg(v-if='block.subhead' v-html='block.subhead')
				.subhead(v-if='block.copy' v-html='block.copy')
				.video-controls(v-if='block.video')
					.play-btn.mobile(@click='videoactive = !videoactive')
							span.mobile watch video
							.arrow
		.video-controls(v-in-viewport.once v-if='block.video')
			.play-btn.desktop(@click='videoactive = !videoactive')
					span.desktop play
					.arrow


</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['block']

	components:
		'video-modal': require '~/components/global/video-modal'
		'diagonal-slash': require '~/components/global/diagonal-slash'

	# If you want to disable the v-in-viewport.once just set this to true to go to the *active state* and add {activate: move} to the parent class
	data: ->
		move: false
		video: false
		videoactive: false

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

// The transitions for this block is in the slide-in.stly and the mixins is in definitions.
.content-wrapper
	transition transform 1s easeOutQuart, opacity 1s ease 300ms
	-webkit-transform-style preserve-3d
	-webkit-backface-visibility hidden
	opacity 0
	&.in-viewport
		opacity 1


.image-left
	.foreground
		padding-left gutter
	.content-wrapper
		transform translateX(50%)
		&.in-viewport
			transform translateX(0)
			
.image-right
	.foreground
		padding-right gutter
	.content-wrapper
		transform translateX(-50%)
		&.in-viewport
			transform translateX(0)


.video-controls
	opacity 0
	transition opacity 300ms 500ms ease-out
	&.in-viewport
		opacity 1
	@media (max-width tablet) 
		opacity 1
	
		
.content
	z-index 1
	
.copy-and-image
	display flex
	width 100%
	height 100%
	overflow-x hidden
	overflow-y hidden
	position relative


.top-slide
	width 100%
	position relative
	display flex
	align-items center
	padding-h(gutter-mobile)
	min-height rem(482px)
	@media (max-width mobile)
		padding-v 5%
		min-height 240px
		

.bkgd
	width 100%
	height 100%
.foreground
	align-items center
	// padding 0 10px
	
.image
	display flex
	@media (max-width mobile)
		display none
	@media (min-width S)
		position absolute
		top 0
		bottom 0

.white
	.content
	.content-wrapper
		background white
		
.grey
	.content
	.content-wrapper
		background light-grey
		
// Copy block
.content-wrapper
	padding slash-pad
	
.content
	max-width rem(680px)
	width 100%
	background white
	position relative
	@media (max-width mobile)
		margin h-pad-mobile
		width auto
		max-width 100%

.image-right
	@media (min-width S)
		.content
			margin-right auto
		.top-slide
			vw-until(padding-right, 7.5, break = max-w)

	&.quarter
		top-slide-in-copy_image('right', quarter-width)

	&.third
		top-slide-in-copy_image('right', third-width)

	&.half
		top-slide-in-copy_image('right', half-width)

.image-left
	@media (min-width S)
		.content
			margin-left auto
		.top-slide
			vw-until(padding-left, 7.5, break = max-w)

	&.quarter
		top-slide-in-copy_image('left', quarter-width)

	&.third
		top-slide-in-copy_image('left', third-width)

	&.half
		top-slide-in-copy_image('left', half-width)


// Half class needs differnt break points so it doesn't look weird between S->M
.half
	@media (max-width tablet)
		.top-slide
			padding-h(gutter-mobile!important) // Needed to override the style just for tablet
			margin auto !important
			padding-v 5%
			
		.video-controls
			margin h-pad-mobile
			margin-left 0
		
		.mobile
			display flex!important

		.content
			margin h-pad-mobile
			width auto
			max-width 100%

		.wysiwyg
		.subhead
			margin-left 0
			margin-left 0


// Video Controls
.video-controls
	.mobile
		display none
	@media (max-width S)
		margin h-pad-mobile
		margin-left 0
		.mobile
			display flex
		.desktop
			display none

.play-btn
	display flex
	justify-content center
	align-items center
	&.mobile
		width 191px
		height 50px
		blockThemeColor background-color
	&.desktop
		border-radius 50%
		z-index 5
		position absolute
		top 50%
		background-color rgba(255, 255, 255, 0.8) 
		height rem(130px)
		width @height
		transition background-color 400ms ease
		&:hover
			background-color white !important
		span
			blockThemeColor color
		.arrow
			blockThemeColor border-color

		&:hover
			cursor pointer
			.arrow
				animation bounceright-video .3s alternate ease infinite

	span
		display block
		button-style()
		font-size 22px
		color white
		&:hover
			cursor pointer

	.arrow
		transform rotate(-90deg)
		margin-left 6px
		border-top rem(8px) solid white
		// needs important here to let the arrow get the blocktheme color
		border-left rem(8px) solid transparent!important
		border-right rem(8px) solid transparent!important
		transition transform 300ms ease-in-out


</style>
