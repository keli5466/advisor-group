<!--
The anchor links template
-->

<template lang='pug'>

.anchor-links
	.inner-max-w
		.label {{ block.link_label }}
		.nav-wrap
			anchor-link(v-for='(link, index) in block.links'
				:name='link.name'
				:anchor='link.anchor'
				:key='index')

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	components: 'anchor-link': require './link'
	props: ['block']

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.anchor-links
	background #f4f4f4
	padding rem(27px) 5px

.inner-max-w
	eyebrow-title()
	display flex
	align-items center

.label
	flex-shrink 0
	margin auto 0
	display inline-block
	// Dash
	&:after
		content ''
		display inline-block
		vertical-align middle
		height rem(36px)
		margin-left 10px
		border-right 1px solid silver
		transform rotate(35deg) //EB

.nav-wrap
	display flex
	margin-h(auto)
	flex-wrap wrap

.label
	left-spacing()
	font-weight normal
	margin-top 1px

.link
	margin-left rem(48px)
	line-height 20px //Calc'd and EB from the height of the dash
	transition color 200ms cubic-bezier(0.77, 0, 0.175, 1)
	&:hover
		cursor pointer
		color lighten(dark-grey, 60%)


@media (max-width mobile)
	.nav-wrap
	.inner-max-w
		flex-direction column
	.anchor-links
		padding 19px 0 0px
	.label
		margin-bottom 13px
	.link
		margin-h(auto)
		text-align center
		line-height normal
		margin-bottom rem(26px)

</style>
