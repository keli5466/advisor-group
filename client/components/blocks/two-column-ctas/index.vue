<!--
The Two Column Icon Touts Block
-->

<template lang='pug'>

.block.two-column-ctas.inner-max-w.block-v-marg(:class='block.layout'
	:data-anchor='block.slug')
	.content
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


.content
	display flex
	flex-direction row
	flex-wrap wrap


>>>.cta-card
	.separate &
		width 48%
		background white
		corner-card()

		&:not(last-of-type)
			margin-right auto
			@media (max-width tablet)
				margin-bottom 20px

		@media (max-width tablet)
			width 100%

	.single &
		width 50%
		background white
		position relative
		@media (max-width tablet)
			width 100%

		&:first-child:after
			content ''
			position absolute
			right 0
			top 50%
			transform translateY(-50%)
			height 80%
			border-right 1px solid silver
			@media (max-width tablet)
				border-right 0
				border-bottom 1px solid silver
				width 85%
				bottom 0
				center()
				height 100%
				@media (max-width mobile)
					width 90%





</style>
