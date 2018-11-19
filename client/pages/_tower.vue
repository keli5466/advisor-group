<!--
Build a tower page
-->

<template lang='pug'>

.tower
	blocks(:blocks='tower.blocks')
</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
import { parseError, seo } from '~/utils/page'
import { loadBlockData } from '~/utils/has-blocks'
export default

	components: blocks: require '~/components/global/blocks'

	# Title / SEO
	head: -> seo @tower

	# Redirect /home to /
	beforeRouteEnter: (to, from, next) ->
		if to.path == '/home' then next '/' else next()

	# Get home page data and blocks
	asyncData: (context) ->
		{ params, error, app, env } = context

		# Lookup the tower
		slug = params.tower || 'home' # Serve root from "home" tower
		try { data: tower} = await app.$api.get "tower/#{slug}"
		catch e then return error parseError e

		# Hydrate some blocks with additional data so that it gets SSRed
		await loadBlockData context, tower.blocks

		# Save the tower and site
		{ tower }

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.tower
	html.ie &
		min-height 100vh

.btn
	blockThemeColor background-color
	color white

.outline-btn
	background white
	blockThemeColor color

.wysiwyg
	u:before
		blockThemeColor border-bottom-color, 0.4

</style>
