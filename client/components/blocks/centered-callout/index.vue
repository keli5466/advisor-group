<!--
The Centered Callout Block
-->

<template lang='pug'>

.block.centered-callout.block-v-pad(:data-anchor='block.slug')

	.copy
		diagonal-slash(direction='' left='55%')
		.headline(v-if='block.headline') {{ block.headline }}
		.wysiwyg(v-if='block.copy' v-html='block.copy')

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['block']
	components:
				'diagonal-slash': require '~/components/global/diagonal-slash'
</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>
// The same as image-copy block
.centered-callout
	padding-h(gutter-mobile)
	position relative
	overflow hidden //needed for slash

.copy
	max-width rem(640px)
	padding 10px 0 20px
	text-align center
	margin auto
	background white
	position relative
	@media (max-width mobile)
		text-align left
		margin h-pad-mobile
		width auto
		padding-v rem(50px)


.headline
	eyebrow-title()

.wysiwyg
	wysiwyg-copy()
	margin-v(rem(18px))

</style>
