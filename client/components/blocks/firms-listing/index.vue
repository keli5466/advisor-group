<!--
The Firms Listing Block
-->

<template lang='pug'>

.block.firms-listing.block-v-pad(:class='block.layout')
	visual.background(v-if='block.imgs.firms_listing_background.l'
		background-position='center bottom'
		:load='true'
		:image='block.imgs.firms_listing_background.l')

	.inner-max-w

		.intro(v-if='minimal')
			//- diagonal-slash
			.headline {{ block.headline }}
			.subhead.wysiwyg(v-html='block.subhead')

		.firms
			//- Render either the firms bar or the expanded list
			firms-bar(v-if='minimal' :firms='block.firms')
			firms-list(v-if='!minimal' :firms='block.firms')

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['block']
	components:
		'firms-bar': require '~/components/firms/firms-bar'
		'firms-list': require '~/components/firms/firms-list'
		'diagonal-slash': require '~/components/global/diagonal-slash'

	computed:

		minimal: -> return true if @block.layout == 'minimal'

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.block
	position relative
	overflow hidden

.expanded
	background-color light-grey
	&.block-v-pad
		padding-top 0

.background
	max-width max-w
	height 100%
	margin-h(auto)
	position absolute
	left 0
	right 0
	bottom 0
	z-index -1
	width 100%
	opacity 0.3
	@media (min-width max-w) 
		&:before
			left -1px
			background-image linear-gradient(to right, #ffffff, rgba(255, 255, 255, 0))
		&:after
			right -1px
			background-image linear-gradient(to left, #ffffff, rgba(255, 255, 255, 0))
		&:before
		&:after
			content ''
			width rem(234px)
			position absolute
			z-index 1
			height 100%


.intro
	position relative
	text-align center

.headline
	eyebrow-title()
	margin-bottom rem(18px)

.intro
	max-width rem(640px)
	margin auto

.wysiwyg
	wysiwyg-copy()
	margin-bottom rem(50px)

</style>
