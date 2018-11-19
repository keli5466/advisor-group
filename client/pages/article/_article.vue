<!--
Build an article page
-->

<template lang='pug'>

.article
	eloqua-gate(v-if='article.gated === "1" && !hasSubscribed'
		:els='els')
	template(v-else)
		.marquee(:class='{ true : article.imgs.marquee.l}')
			visual.bkgd(v-if='article.imgs.marquee.l'
				:image='article.imgs.marquee.l'
				:load='true')
			.inner-max-w
				.eyebrow(v-if='article.eyebrow') {{ article.eyebrow }}
				h1.headline(v-if='article.title') {{ article.title }}

		.body
			.main-copy.wysiwyg.inner-max-w(v-html='article.body')
			.block-v-pad(v-if='article.blocks')
			blocks(:blocks='article.blocks')

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
import { parseError, seo } from '~/utils/page'
import { loadBlockData } from '~/utils/has-blocks'
export default

	components:
		'eloqua-gate': require '~/components/global/eloqua-gate'
		blocks: require '~/components/global/blocks'

	data: -> hasSubscribed: false

	# Title / SEO
	head: -> seo @article
	
	mounted: ->
		if localStorage.hasSubscribedToResources
			@hasSubscribed = localStorage.hasSubscribedToResources
			@$store.commit 'layout/set', backgroundedHeader: false

	# Get home page data and blocks
	asyncData: (context) ->
		{ params, error, app, env } = context

		# Lookup the gate content elements
		try { data: els } = await app.$api.get "layout/resources_gate"
		catch e then return error parseError e

		# Lookup the article
		slug = params.article || 'home' # Serve root from "home" article
		try { data: article } = await app.$api.get "article/#{slug}"
		catch e then return error parseError e

		# Hydrate some blocks with additional data so that it gets SSRed
		await loadBlockData context, article.blocks

		# Save the article and site
		{ article, els }
	
	methods:
		
		removePrimary: ->
			console.log('removed')
			target = document.querySelector '.primary'
			target.classList.remove('contact')

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.bkgd
	position absolute
	left 0
	right 0
	top 0
	bottom 0
	width 100%
	height 100%
	z-index -1

.eyebrow
	eyebrow-title()

.headline
	headline()
	left-spacing()

// WITHOUT marquee

.marquee
	padding-top rem(126px)

	.inner-max-w
			width 90%
			max-width rem(1000px)
			margin-h auto

			@media (max-width tablet)
				width 100%
				margin-h gutter-mobile

		.eyebrow
			color black
			margin-bottom 12px
			@media (max-width mobile)
				margin-bottom 8px

		.headline
			color black
			margin-left l-pad-inner

			@media (max-width mobile)
				margin-left 0
				font-size 34px,true
				margin-bottom rem(35px)

			@media (min-width mobile)
				margin-bottom rem(50px)
				font-size rem(50px)

// WITH Marquee
.marquee
	&.true
		height rem(550px)
		position relative
		display flex
		flex-direction column
		margin-bottom rem(90px)
		padding-top 0
		@media (max-width mobile)
			padding-v (rem(35px))
			margin-bottom rem(40px)

		.inner-max-w
			margin-v auto
			max-width inner-max-w
			width auto
			margin-h auto

			@media (max-width max-w)
				margin-h gutter-wide

			@media (min-width max-w)
				width 100% //IE

			@media (max-width tablet)
				margin-top auto
				margin-bottom rem(35px)

			@media (max-width mobile)
				margin-h gutter-mobile

			.eyebrow
					margin-bottom rem(21px)
					color white
					@media (max-width mobile)
						margin-bottom 0px

			.headline
				headline()
				@media (max-width mobile)
					margin-bottom 0
					font-size 38px, true

.blocks
	background light-grey

	
.body
	>>>.main-copy
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
		u
			blockThemeColorArticle underline, 0.4

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

.btn
	blockThemeColor background-color
	color white

.outline-btn
	background white
	blockThemeColor color

.wysiwyg u
		blockThemeColor underline, 0.4

</style>
