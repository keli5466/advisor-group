<!--
The current site brand logo
-->

<template lang='pug'>

nuxt-link.brand-logo(to='/'
	:class='[logo, {home: isHome}]')

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default

	props: ['isHome']

	computed:
		logo: -> return 'icon-' + process.env.SITE_SLUG

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.home
	visibility hidden
	transition visibility 200ms ease-in-out

	.backgrounded &
		visibility visible

</style>
