<!--
The blurb
-->

<template lang='pug'>

.blurb(v-parse-anchors)
	.headline(v-if='blurb.headline' v-html='blurb.headline')
	.copy(v-if='blurb.copy' v-html='blurb.copy')
	a.learn-more(v-if='blurb.url'
		:href='blurb.url') {{ blurb.cta }}

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['blurb']
</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.headline
	wysiwyg-copy()

.copy
	bullet-copy()

</style>
