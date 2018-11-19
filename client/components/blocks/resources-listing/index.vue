<!--
The Resources Listing Block
-->

<template lang='pug'>

.block.block-v-pad.resources-listing(:data-anchor='block.slug')
	.resources.inner-max-w.stager(v-in-viewport.once)

		article-list-item(v-in-viewport.once v-for='(article, index) in block.articles.data'
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

			newArticles = articles.blocks.find((i) -> i.type == 'resourcesListing')
			@block.articles = newArticles.articles

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>


.block
	background light-grey

.resources
	display flex
	flex-wrap wrap
	@media (max-width desktop)
		justify-content space-between

</style>
