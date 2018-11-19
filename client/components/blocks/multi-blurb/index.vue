<!--
The multi blurb block
-->

<template lang='pug'>

.block.multi-blurb.slide-in(v-in-viewport.once
	:class='[ align,block.layout,block.theme,{activate: move}]'
	:data-anchor='block.slug')
	.image
		visual.bkgd(v-if='block.imgs.multi_blurb_background.l'
			:load='true'
			:image='block.imgs.multi_blurb_background.l')
	.top-slide.block-v-pad
		.content
			.copy-wysiwyg.fade-in(v-in-viewport.once)
				.eyebrow(v-if='block.headline') {{ block.headline }}
				.headline.wysiwyg(v-if='block.copy'
					v-html='block.copy')
			.touts.stager(v-in-viewport.once)
				icon-tout(v-for='(tout, index) in block.icon_touts'
					:key='index'
					layout='vertical'
					:tout='tout')
			.blurbs.stager(v-in-viewport.once)
				blurb(v-for='(blurb, index) in block.blurbs'
					:key='index'
					:blurb='blurb')

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['block']
	components:
		'blurb': require '~/components/global/blurb'
		'icon-tout': require '~/components/global/icon-tout'

	data: ->
		move: false
		# If you want to disable the v-in-viewport.once just set this to true to go to the *active state* and add {activate: move} to the parent class
		# move: true

	computed:
		align: ->
			if @block.align
				return 'image-' + @block.align
			return 'image-left'

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>
.block
	display flex
	width 100%
	overflow-x hidden
	position relative

.image
	display flex
	@media (max-width mobile)
		display none


.image
	@media (min-width XL-max)
		width 'calc(50vw - %s / 2)' % (inner-max-w) !important

.image-right
	top-slide-in('right', gutter-wide)

	.content
		@media (min-width desktop)
			padding-right page-margin

	.top-slide
		@media (min-width max-w)
			margin-right 'calc(50vw - %s / 2)' % (inner-max-w)

.image-left
	top-slide-in('left', gutter-wide)

	.content
		@media (min-width desktop)
			padding-left page-margin

	.top-slide
		@media (min-width max-w)
			margin-left 'calc(50vw - %s / 2)' % (inner-max-w)


.content
	max-width inner-max-w
	width 100%
	@media (max-width desktop)
		padding-h page-margin
	@media (max-width tablet)
		padding-h gutter

.copy-wysiwyg
	max-width rem(800px)
	@media (max-width mobile)
		margin-h auto


.blurbs
.touts
	left-spacing()
	display flex
	flex-direction row
	flex-wrap wrap
	justify-content space-between
	margin-v rem(45px)
	@media (max-width tablet)
		margin-v 40px

.blurbs
	justify-content flex-start
// Shared between blurn and icon tout. the seperate styles are below
>>>.blurb
>>>.icon-tout

	padding rem(30px)
	//
	// .learn-more
	//
	// 	// &:hover
	// 	// 	&:after
	// 	// 			animation bounceright .3s alternate ease infinite
	// 	//
	//
	//
	// 	cta-style()
	// 	blockThemeColor color
	// 	position relative
	// 	padding-right 10px
	// 	display inline-block
	// 	margin-top rem(18px)
	//
	// 	&:before
	// 		content ''
	// 		box-sizing border-box
	// 		height 9px
	// 		width 9px
	// 		border-style solid
	// 		blockThemeColor border-color
	// 		border-width 0 3px 3px 0
	// 		font-family 'icomoon'
	// 		position absolute
	// 		right 0
	// 		top 50%
	// 		transform translateY(-50%) rotate(-45deg)


	.headline
		font-size 22px
		margin-bottom 11px
		@media (max-width tablet)
			font-size 18px,true


>>>.icon-tout
	max-width rem(490px)
	width 49%
	@media (max-width tablet)
		width 100%
		max-width 100%
		&:not(:last-of-type)
			margin-bottom 20px
	.grey &
		background white
	.white &
		background light-grey
	.icon
		width 59px
		margin-bottom 18px

>>>.blurb

	width 33.3%
	@media (max-width desktop)
		width 50%
	@media (max-width mobile)
		width 100%
		padding-v 15px



</style>
