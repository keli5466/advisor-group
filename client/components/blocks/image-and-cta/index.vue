<!--
The Image and CTA Block
-->

<template lang='pug'>

.block.image-and-cta.inner-max-w.corner-card.block-v-marg(:class='[block.theme,block.layout]'
	:data-anchor='block.slug')
	visual.image(v-if='block.imgs.image_and_cta_image.l'
		:load='true'
		:image='block.imgs.image_and_cta_image.l')
	.touts
		.eyebrow(v-if='block.eyebrow') {{ block.eyebrow }}
		.headline(v-if='block.headline') {{ block.headline }}
		cta-card(v-for='(cta, index) in block.cta_cards'
			:key='index'
			:cta='cta')

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['block']
	components: 'cta-card': require '~/components/global/cta-card'

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.image-and-cta
	position relative
	display flex
	justify-content space-between
	@media (max-width tablet)
		flex-direction column

.image-right
	flex-direction row-reverse
	@media (max-width tablet)
		flex-direction column

.image
	position relative
	display block
	width 50%
	@media (max-width tablet)
		width 100%
		aspect-ratio(4/3)

.background
	position absolute
	top 0
	left 0
	width 100%
	height 100%

.touts
	width 50%
	background white
	@media (max-width tablet)
		width 100%

</style>
