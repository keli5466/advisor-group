<!--
The Icon Touts and Image Block
-->

<template lang='pug'>

.block.icon-touts-and-image.slide-in(
	v-in-viewport.once
	:class='[ block.layout, block.theme]'
	:data-anchor='block.slug')
	.image
		visual.bkgd(v-if='block.imgs.icon_touts_and_image_image.l'
			:load='true'
			:image='block.imgs.icon_touts_and_image_image.l')

	.top-slide.block-v-pad
		.content
			.copy-wysiwyg.fade-in(v-in-viewport.once)
				diagonal-slash(direction='down' left='15%')
				.eyebrow(v-if='block.eyebrow') {{ block.eyebrow }}
				.headline(v-if='block.headline') {{ block.headline }}
			.touts.stager(v-in-viewport.once)
				icon-tout(v-for='(tout, index) in block.icon_touts'
					:key='index'
					:tout='tout'
					:class='[{multi: block.icon_touts.length > 4},{normal: block.icon_touts.length < 4}]'
					v-in-viewport.once
					layout='vertical')

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['block']
	components:
		'icon-tout': require '~/components/global/icon-tout'
		'diagonal-slash': require '~/components/global/diagonal-slash'
		

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

// Place padding rules in the child of top-slide
.icon-touts-and-image
	display flex
	width 100%
	overflow-x hidden
	position relative

.image
	@media (min-width XL-max)
		width 'calc(50vw - %s / 2)' % (inner-max-w) !important

.image-left
	top-slide-in('left', gutter-wide)

.image-right
	top-slide-in('right', gutter-wide)

@media (min-width max-w)
	.image-right
		.top-slide
			margin-right 'calc(50vw - %s / 2)' % (inner-max-w)
	.image-left
		.top-slide
			margin-left 'calc(50vw - %s / 2)' % (inner-max-w)

.touts
	display flex
	flex-direction row
	flex-wrap wrap
	left-spacing()
	justify-content space-between

.content
	padding-h (page-margin)
	max-width inner-max-w
	width 100%
	@media (max-width mobile)
		padding gutter
		
.eyebrow
	margin-bottom 0
	
.headline
	margin-top 13px
	
.copy-wysiwyg
	position relative
	padding slash-pad

.icon-tout
	max-width 300px
	width 30%
	margin-top rem(60px)
	&.normal
		@media (max-width M)
			margin-top 35px
			max-width 100%
			width 100%
	&.multi
		margin-top rem(40px)
		>>>
			.icon
				margin 0 auto
			.wrapper
				text-align center
		@media (max-width S)
			width 50%
			margin-top rem(35px)
			max-width 100%
			text-align center
			padding 0 5px
			>>>.icon
				margin-left auto
				margin-right auto
	>>>
		.headline
			font-size 22px
			line-height 1.18
			margin-bottom rem(6px)
			@media (max-width tablet)
				font-size 18px, true
				margin-bottom 3px

		.copy
			a
				text-decoration underline

		.icon
			width rem(78px)
			margin-bottom rem(20px)
			img
				width 100%
			@media (max-width mobile)
				margin-bottom 8px


</style>
