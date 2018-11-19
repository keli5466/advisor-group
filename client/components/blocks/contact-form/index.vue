<!--
Contact Form Block
-->

<template lang='pug'>

.block.contact-form(v-in-viewport.once :data-anchor='block.slug')
	.image
		visual.bkgd(v-if='block.imgs.contact_form_background.l'
			:load='true'
			:image='block.imgs.contact_form_background.l')
		.details
			h2.headline {{ block.headline }}
			.contact.wysiwyg(v-html='block.details')

	.top-slide
		.form
			eloqua-form(v-if='block.fields'
				:successMessage='block.success'
				:fields='block.fields'
				type='footer')

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
import { parseError, seo } from '~/utils/page'
export default
	props: ['block']

	components: 'eloqua-form': require '~/components/global/eloqua-form'

	asyncData: ({ store }, block, extra) =>

		# Fetch form related data
		[ success, fields ] = await Promise.all [
			store.dispatch 'cache/get', 'layout/forms/success'
			store.dispatch 'cache/get', 'form/footer'
		]
		Vue.set block, 'success', success
		Vue.set block, 'fields', fields

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.block
	display flex
	width 100%
	height 100%
	overflow-x hidden
	position relative
	@media (max-width tablet)
		flex-direction column
		.form
			margin-h(auto)
		.top-slide
			padding-h(gutter-mobile)
			margin auto

.image
	position relative
	display flex
	align-items center
	
.image
.top-slide
	width 50%
	@media (max-width tablet) 
		width 100%
	
.bkgd
	width 100%
	position absolute
	left 0
	top 0
	height 100%

// text on top of image
.details
	width 'calc((%s/2) / 1.5)' % (rem(inner-max-w))
	z-index 1
	margin auto gutter-wide
	padding-v 50px
	padding-left 5%
	@media (min-width max-w)
		margin-left 'calc(50vw - %s / 2)' % (inner-max-w)

.wysiwyg
	color white
	>>> p //Override
		margin 0
	>>> a
		text-decoration none

.headline
	font 'regular', 42px, white
	font-weight 300
	line-height 1.31
	margin-bottom rem(26px)

.top-slide
	padding-v(gutter)
	background light-grey
	@media (min-width max-w)
		padding-right 'calc(50vw - %s / 2)' % (inner-max-w)

// Placeholder until form is inserted
.form
	margin auto
	width 80%
	max-width rem(490px)
	@media (min-width max-w)
		padding-left 20px
		width 'calc(%s / 2 - %s)' % (inner-max-w page-margin)


</style>
