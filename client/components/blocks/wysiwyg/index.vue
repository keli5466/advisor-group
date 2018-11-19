<!--
The Wysiwyg Block
-->

<template lang='pug'>

.block.main-copy.wysiwyg.block-v-pad.inner-max-w(
	:data-anchor='block.slug'
	v-html='block.wysiwyg')

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['block']

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

	

.main-copy
	padding-bottom 'calc(%s - 70px)' % (v-pad) //customizes block-v-pad so the last item in the wysiwyg doesnt need a margin 0.
	font 'prox', 24px, dark-grey
	font-weight 300
	line-height 1.58
	@media (min-width mobile)
		width 80%
		max-width rem(800px)
		margin-h auto

	@media (max-width mobile)
		line-height 1.5
		font-size 16px,true

	// makes first p larger
	p:first-of-type
		wysiwyg-copy()

	>>>.form-iframe
			@media (min-width M)
				margin-top -4.25rem
	// vertical spacing
	p
	ul
	figure
		margin-bottom rem(35px)

		.underline
			border-bottom 1px solid dark-grey

		figure
			width 100%
			margin-h 0
			margin-top 0 //overrides user ageny styles

			img
				width 100%

			figcaption
				margin-v rem(15px)
				bullet-copy()
				text-align right
				margin-left rem(100px)
				color grey
				@media (max-width mobile)
					font-size 14px,true
					line-height 1.43
					letter-spacing 0.2px

		ul
			margin-left 0

			li
				list-style none
				position relative
				padding-left rem(40px)
				margin-top 18px
				&:before
					content '\2022'
					blockThemeColor color
					height rem(6px)
					width @height
					position absolute
					left 0
				@media (max-width mobile)
					padding-left 10px

</style>
