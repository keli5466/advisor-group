<!--
The Icon Tout
-->

<template lang='pug'>

.cta-card
	.headline(v-if='cta.headline' v-html='cta.headline')
	.subhead.wysiwyg(v-if='cta.subhead' v-html='cta.subhead')
	.copy(v-if='cta.copy' v-html='cta.copy')
	a.btn(:href='cta.url') {{ cta.cta }}

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['cta']
</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.headline
	eyebrow-title()

.wysiwyg
	font-size rem(36px)
	margin-v rem(25px)
	@media (max-width desktop)
		font-size rem(30px)
		margin-v rem(20px)
	@media (max-width mobile)
		font-size 20px, true
		margin-top 12px
		margin-bottom 15px



.copy
	body-copy()
	font-weight normal
	padding-v rem(30px)
	position relative
	@media (max-width mobile)
		font-size 16px, true
		line-height 1.5
		font-weight 300
		padding-v 22px

	&:before
		position absolute
		top 0
		left 0
		width rem(106px)
		content ''
		border-top solid 1px silver

.btn
	blockThemeColor background
	button-style()
	display flex
	align-items center
	justify-content center
	height rem(60px)
	width rem(215px)
	@media (max-width tablet)
		height 50px
		width 197px



.cta-card
	padding rem(60px) rem(40px) rem(60px) rem(60px)
	@media (max-width mobile)
		padding 30px 20px



</style>
