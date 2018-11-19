<!--
The minimal firms bar list
-->

<template lang='pug'>

.firms-bar.stager(v-in-viewport.once)
	.firm(v-for='(firm, index) in firms'
		:key='index')
		visual.logo(v-if='firm.imgs.dark_logo.l'
			:image='firm.imgs.dark_logo.l'
			:load='true'
			background='')

		a.outline-btn(v-if='firm.url'
			:href='firm.url') {{ firm.cta }}

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['firms']
</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.firms-bar
	position relative
	display flex
	justify-content space-between
	flex-wrap wrap
	@media (max-width tablet)
		justify-content center

.firm
	width 23.5%
	display flex
	flex-direction column
	border-color #eff5f1
	border-width 0 10px 10px 0
	border-style solid
	text-align center
	background white
	padding rem(30px)


	@media (max-width desktop)
		flex 1 1 250px
		margin 0 20px 20px 0
		max-width 335px

		.outline-btn
			max-width 230px
			margin-h auto

		@media (max-width mobile)
			margin rem(10px) auto

	&:nth-child(4) .logo
		max-width 180px

// overrides the button class to always have the button be aligned with the logos
// Flex is used here so the button always stays the same height regardless if one word breaks to two lines
.outline-btn
	width 100%
	flex auto
	display flex
	justify-content center
	align-items center
	font-size 14px, true
	padding-h(0)
	blockThemeColor color


.logo
	max-width 230px
	height 70px
	display block
	margin-h auto
	margin-bottom rem(35px)
	display flex
	justify-content center
	align-items center
	>>>.vv-image
		width 100%


</style>
