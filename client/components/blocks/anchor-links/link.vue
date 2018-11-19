<!--
The individual anchor link
-->

<template lang='pug'>

.link(@click='anchorDown')
	.name.learn-more {{ name }}

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['name', 'anchor']

	methods:
		anchorDown: ->
			target = document.querySelector '[data-anchor="'+@anchor.substr(1)+'"]'
			@$velocity document.documentElement, 'scroll', {
				offset: target.offsetTop - 70
			}, {
				duration: 1000
			}

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.learn-more
	margin-top 0
</style>
