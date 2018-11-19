<!--
The full bleed cta block
-->

<template lang='pug'>

.block.full-bleed-cta(:data-anchor='block.slug')
	visual.bkgd(v-if='block.imgs.full_bleed_cta_background.l'
		:load='true'
		:image='block.imgs.full_bleed_cta_background.l')
	.inner-max-w
		.copy-wysiwyg
			.eyebrow(v-if='block.eyebrow') {{ block.eyebrow }}
			.headline.wysiwyg(v-if='block.headline' v-html='block.headline')
			p.subhead(v-if='block.copy' v-html='block.copy')
			a.cta.btn(v-if='block.url'
				:href='block.url') {{ block.cta }}

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['block']

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.block
	position relative
	height rem(680px)
	display flex
	align-items center
	@media (max-width mobile)
		height auto
		padding-v rem(45px)


.bkgd
	width 100%
	position absolute
	left 0
	right 0
	z-index -1
	top 0
	bottom 0
	height 100%

.inner-max-w
	margin-v auto
	width 100%

.copy-wysiwyg
	width 60%
	display flex
	flex-direction column
	max-width rem(700px)

	.subhead
		max-width rem(480px)
		@media (max-width mobile)
			max-width 100%

	@media (max-width mobile)
		max-width 100%
		width auto
		.cta
			width 100%



.cta
	width rem(280px)
	margin-top rem(48px)
	margin-left auto
	blockThemeColor background
</style>
