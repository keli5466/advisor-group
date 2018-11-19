<!--
The Copy and Icon Bullet Point Block
-->

<template lang='pug'>

.block.copy-and-icon-bullet-point(
	:data-anchor='block.slug'
	:class='block.theme')
	.inner-max-w
		.copy-wysiwyg
			diagonal-slash(direction='down' left='50%')
			.content-wrapper
				.eyebrow(v-if='block.headline') {{ block.headline }}
				p.wysiwyg(v-if='block.copy' v-html='block.copy') 

		.bullets.corner-card.stager(v-in-viewport.once)
			icon-tout(v-for='(tout, index) in block.icon_touts'
				:key='index'
				:tout='tout'
				layout='horizontal')

</template>

<!-- –––––––––––––––––––––––––	–––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['block']
	components: 
		'icon-tout': require '~/components/global/icon-tout'
		'diagonal-slash': require '~/components/global/diagonal-slash'
	

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.white
	background white
	.bullets
		background light-grey
	.content-wrapper
		background white

.grey
	background light-grey
	.bullets
		background white
	.content-wrapper
		background light-grey

.inner-max-w
	overflow hidden // needed for slash
	display flex
	flex-direction row
	align-items center
	padding-v rem(60px)
	@media (max-width M)
		padding-v rem(35px)
		flex-direction column

		.bullets
			width 100%
			z-index 2

		.copy-wysiwyg
			width auto
			max-width 100%
			margin-h(h-pad-mobile)
			padding-bottom 30px

.copy-wysiwyg
	width 50%
	position relative
	margin-right rem(76px)
	max-width rem(540px)
	z-index 1

.content-wrapper
	padding 10px 0 20px

.bullets
	z-index 1
	width 50%
	padding rem(40px)

>>>
	.icon-tout

		.wrapper
			display flex

			@media (max-width mobile)
				flex-direction column !important

		.headline
			line-height 1.43
			margin-bottom rem(12px)
			@media (max-width mobile)
				line-height 1.6

		.icon
			width 56px
			height @width
			img
				width 56px
			@media (max-width mobile)
				margin-bottom 8px

		&:not(:last-of-type)
			margin-bottom rem(35px)

		.content
			margin-left h-pad-mobile
			@media (max-width mobile)
				margin-left 0


</style>
