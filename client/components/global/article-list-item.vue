<!--
The article listing item
-->

<template lang='pug'>

.article-list-item.corner-card
	.wrapper
		visual.image(v-if='content.imgs.listing.l'
			:load='true'
			:image='content.imgs.listing.l')
		.eyebrow(:class='{bg : content.imgs.listing.l}') {{ content.tag }}
		.content
			.headline {{ content.title }}
			.abstract(v-html='content.abstract')
			nuxt-link(:to='route') {{ readMore }}

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['content']

	computed:
		
		readMore: -> if @content.cta_text then @content.cta_text else 'Read More'
		
		route: -> "/#{@content.type}/#{@content.slug}"
		
</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.article-list-item
	width 32%
	position relative
	margin-bottom rem(40px)
	margin-left 2%
	&:nth-child(3n+1)
		margin-left 0
	@media (max-width desktop)
		width 48.5%
		margin-left 0
	@media (max-width mobile)
		width 100%
		margin-bottom 35px

.wrapper
	display flex
	background white
	flex-direction column
	transform-origin top left
	height 100%
	transition transform 400ms ease-out
	@media (min-width S)
		&:hover
			transform scale(1.015)


.content
	padding gutter-mobile
	display flex
	flex-grow 1
	flex-direction column

.headline
	wysiwyg-copy()
	margin-bottom rem(24px)
	@media (max-width tablet)
		font-size 18px, true
		line-height 1.67
		letter-spacing normal

.eyebrow
	eyebrow-title()
	color white
	padding-left gutter-mobile
	padding-top gutter-mobile
	font-size 14px, true
	&.bg
		position absolute
		top 0
		left 0

a
	cta-style()
	margin-left auto
	margin-top auto
	position relative
	blockThemeColor color
	&:after
		content '+'
		font-size 20px
		font-weight 600
		margin-left 5px
		display inline-block
		vertical-align middle
		padding-bottom 1px



.abstract
	body-copy()
	font-weight normal
	padding-v rem(24px)
	position relative
	@media (max-width mobile)
		font-size 15px, true
		line-height 1.5
		font-weight 300
		padding-v 15px

	&:before
		position absolute
		top 0
		left 0
		width rem(114px)
		content ''
		border-top solid 1px silver

.image
	position relative
	display block
	aspect-ratio(370/223)
	width 100%
	@media (max-width tablet)
		width 100%

	&:after
		content ''
		background black
		opacity 0.1
		top 0
		left 0
		right 0
		bottom 0
		position absolute

</style>
