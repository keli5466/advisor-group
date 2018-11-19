<!--
The Value Props Block
-->

<template lang='pug'>

.block.value-props.slide-in(:class='block.layout' v-in-viewport.once
	:data-anchor='block.slug')
	.image
		visual.bkgd(v-if='block.imgs.value_props_background.l'
			:load='true'
			:image='block.imgs.value_props_background.l')
	.top-slide
		.content.block-v-pad

			.copy-wysiwyg.fade-in(v-in-viewport.once)
				diagonal-slash(v-if='block.layout == "image-right"' direction='down' left='50%')
				diagonal-slash(v-if='block.layout == "image-left"' direction='' right='50%')
				.eyebrow(v-if='block.headline' v-html='block.headline')
				.headline.wysiwyg(v-if='block.subhead' v-html='block.subhead')

			.touts
				icon-tout.corner-card.fade-in.slide-up(v-for='(tout, index) in block.icon_touts'
					:key='index'
					:tout='tout'
					hover='true'
					v-in-viewport.once
					layout='vertical')


			a.btn.fade-in.slide-up(:href='block.url' v-if='block.cta' v-in-viewport.once) {{ block.cta }}

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
import VueMatchHeights from 'vue-match-heights'
# Vue.use('v-match-heights', VueMatchHeights)

export default
	props: ['block']
	components: 
		'icon-tout': require '~/components/global/icon-tout'
		'diagonal-slash': require '~/components/global/diagonal-slash'

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

// Tranition and global styles are in slide-in.styl
// The mixin to make the block slide is in definitions

.block
	display flex
	width 100%
	position relative
	@media (min-width S)
		overflow-x hidden


// Text Styles
.copy-wysiwyg
	position relative
	background white
	padding-top rem(20px)
	padding-bottom rem(20px)
	max-width rem(640px)
	@media (max-width mobile)
		margin-bottom rem(50px)

// Slide Styles vertical padding
.top-slide
	background white
	overflow hidden //needed for slash


.content
	max-width inner-max-w
	width 100%
	@media (max-width wide-break)
		padding-h page-margin
	@media (max-width mobile)
		padding gutter


.image-right
	top-slide-in('right', gutter-wide)
	.btn
		margin-left auto
	.content
		@media (min-width wide-break)
			padding-left page-margin
			padding-right page-margin + gutter-wide

	>>>.icon-tout:nth-child(odd)
			top rem(80px)
			@media (max-width 900px)
				top 0


.image-left
	top-slide-in('left', gutter-wide)
	.btn
		margin-right auto
	.content
		@media (min-width wide-break)
			padding-right page-margin
			padding-left page-margin + gutter-wide

	>>>.icon-tout:nth-child(even)
			top rem(80px)
			@media (max-width 900px)
				top 0


.image
	@media (min-width XL-max)
		width gutter-wide + move-width !important

.touts
	display flex
	flex-flow row wrap
	justify-content space-between
	margin-top rem(80px)



.btn
	blockThemeColor background
	max-width rem(380px)
	width 44%
	justify-content center
	display flex
	@media (max-width 900px)
		width 100%
		max-width 100%


>>>.icon-tout
	width 44%
	position relative
	max-width rem(380px)
	margin-bottom rem(80px)
	.wrapper
		background light-grey
		height 100%
		width 100%
		padding rem(30px)
	@media (max-width 900px)
		width 100%
		max-width 100%
		margin-bottom rem(25px)

	.headline
		font-size 22px

	.copy
		margin-top rem(15px)
		margin-left rem(20px)

	.icon
		max-width rem(247.6px)
		margin-h auto
		width 90%
		margin-bottom rem(30px)

</style>
