<!--
The Two Column Icon Touts Block
-->

<template lang='pug'>

.block.two-column-icon-touts.inner-max-w(:class='block.theme'
	:data-anchor='block.slug')
	.content
		.copy-wysiwyg
			.eyebrow(v-if='block.eyebrow' v-html='block.eyebrow')
			.wysiwyg(v-if='block.headline' v-html='block.headline')
		.touts.stager(v-in-viewport.once)
			icon-tout(v-for='(tout, index) in block.icon_touts'
				:key='index'
				:tout='tout'
				layout='horizontal')

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['block']
	components: 'icon-tout': require '~/components/global/icon-tout'

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.block
	margin-v rem(30px)

.content
	padding-v v-pad
	left-spacing()
	@media (max-width mobile)
		padding-v rem(40px)

.grey
	background light-grey
.white
	background white

.wysiwyg
	font-size rem(36px)

.touts
	display flex
	flex-flow row wrap
	justify-content space-between

.copy-wysiwyg
	padding-bottom v-pad
	@media (max-width mobile)
		padding-bottom rem(40px)

>>>.icon-tout
		width 48%
		align-items center
		max-width rem(500px)
		align-items flex-start

		@media (max-width tablet)
			width 100%
			max-width 100%
			margin-bottom 30px


		&.horizontal
			@media (max-width mobile)
				flex-direction row

		.wrapper
			display inherit

		@media (min-width tablet)
			&:nth-last-child(n+3)
				margin-bottom rem(42px)

		.content
			margin-left rem(51px)
			@media (max-width tablet)
				margin-left 6%

		.icon
			width 74px
			height 73px
			margin-top rem(40px)
			@media (max-width tablet)
				height 67px
				margin-top 0
				width @height


		.headline
			margin-bottom rem(20px)
			line-height 1.43
			@media (max-width mobile)
				margin-bottom 7px
				font-size 18px,true


		.copy
			body-copy()
			@media (max-width mobile)
				font-size 16px, true
				line-height 1.5




</style>
