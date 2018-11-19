<!--
Render a list of blocks
-->

<template lang='pug'>

.blocks: component(
	v-for='block in blocks'
	:is='blockType(block)'
	:key='block.id'
	:block='block')

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
import { keys, mixin } from '~/utils/has-blocks'
export default

	mixins: [ mixin  ]

	props: blocks: Array

	methods:

		# Deal some issues with block types that are also HTML tags
		blockType: (block) -> switch block.type
			when 'map' then 'location-map'
			else block.type

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>



</style>
