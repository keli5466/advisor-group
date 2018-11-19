<!--
Main site layout
-->

<template lang='pug'>

.default-layout
	#main: .error-container
		h1(v-if="error.statusCode === 404") Page not found
		h1(v-else) An error occurred
		nuxt-link.outline-btn(to='/') Home

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['error']

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

#main
	height 60vh
	position relative
	background lighten(dark-grey,50%)

.error-container
	center()
	text-align center
	h1
		font-size 50px
		margin-bottom 10%
	.outline-btn
		&:before
			background white
			opacity 0.2

</style>
