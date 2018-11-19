<!--
The eloqua article gate
-->

<template lang='pug'>

.block.article-gate(v-in-viewport.once)
	.image(:class="{ background: hasImage}")
		visual.bkgd(v-if='els.background'
			:load='true'
			:image='els.background')
		.details
			h1.headline(v-text='els.headline')
			p.subhead(v-text='els.copy')
	.top-slide
		.form
			eloqua-form(v-if='fields'
				:successMessage='success'
				:fields='fields'
				type='resources')

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['els']
	components: 'eloqua-form': require '~/components/global/eloqua-form'

	data: ->
		success: null
		fields: []
		
	computed:
		hasImage: -> @els.background

	created: ->
		@$store.commit 'layout/set', backgroundedHeader: true
		[ @success, @fields ] = await Promise.all [
			@$store.dispatch 'cache/get', 'layout/forms/success'
			@$store.dispatch 'cache/get', 'form/resources'
		]

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
	sitePrimaryThemeColor background-color

	body &.background
		background-color transparent


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
	>>>.vv-fill
		z-index -1
	&:after
		background-color rgba(0, 17, 31, 0.3)
		content ''
		height 100%
		width 100%
		display block

// text on top of image
.details
	width 'calc((%s/2) / 1.5)' % (rem(inner-max-w))
	z-index 1
	color white
	margin auto gutter-wide
	padding-v 50px
	padding-left 5%
	@media (min-width max-w)
		margin-left 'calc(50vw - %s / 2)' % (inner-max-w)

.top-slide
	padding-v(gutter)
	background light-grey
	@media (min-width max-w)
		padding-right 'calc(50vw - %s / 2)' % (inner-max-w)

.form
	margin auto
	padding-v 5%
	width 80%
	max-width rem(490px)
	@media (min-width max-w)
		padding-left 20px
		width 'calc(%s / 2 - %s)' % (inner-max-w page-margin)

.headline
	font 'regular', 36px, white
	font-weight 300
	line-height 1.25
	margin-bottom rem(26px)

.subhead
	body-copy()
	color white
		

</style>
