<!--
Main site layout
-->

<template lang='pug'>

.default-layout
	primary-header
	#main: nuxt
	layout-footer

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default

	components:
		'primary-header': require '~/components/header/primary'
		'layout-footer': require '~/components/footer'

	head: ->
		# Add the layout to the site
		bodyAttrs: layout: 'default'

		# Append site name to the title
		titleTemplate: if @$route.path == '/'
		then '%s'
		else "%s | #{process.env.APP_NAME}"

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>
//pushes page down for menu on contact page
.contact + #main
	margin-top nav-height

// This Helps the IE glitchy when page loads
// The min height is 60vh to consider the error page which is the smaller pages on the site with a set height of 60vh
#main
	html.ie &
		min-height 60vh
</style>
