<!--
The News Listing Block
-->

<template lang='pug'>

.block.block-v-pad.news-listing(:data-anchor='block.slug')
		.articles.inner-max-w.stager(v-in-viewport.once)

			article-list-item(v-for='(article, index) in block.articles.data'
				:key='index'
				:content='article')

			pagination(:data='block.articles'
				@pagination-change-page='getResults')
				span(slot='prev-nav') Previous
				span(slot='next-nav') Next

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
import { parseError, seo } from '~/utils/page'
export default
	props: ['block']
	components:
		'article-list-item': require '~/components/global/article-list-item.vue'

	methods:
		getResults: (page = 1) ->
			try
				{ data: articles } = await @$api.get "tower" + @$router.currentRoute.path + '?page=' + page
			catch	e then console.error parseError e

			newArticles = articles.blocks.find((i) -> i.type == 'newsListing')
			@block.articles = newArticles.articles

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.news-listing
	background light-grey

.articles
	display flex
	flex-wrap wrap
	@media (max-width desktop)
		justify-content space-between
</style>
