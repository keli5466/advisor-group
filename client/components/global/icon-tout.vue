<!--
The Icon Tout
-->

<template lang='pug'>

.icon-tout(:class='layout' v-parse-anchors)
	a.link-container(v-if='tout.url' :href='tout.url')
		.wrapper(:class='{hover: hover}')
			visual.icon(v-if='tout.imgs.icon.l'
				background=''
				:load='true'
				:image='tout.imgs.icon.l')
			.content
				.headline(v-if='tout.headline' v-html='tout.headline')
				.copy(v-if='tout.copy' v-html='tout.copy')
				.learn-more(v-if='tout.cta') {{ tout.cta }}

	template(v-else)
		.wrapper(:class='{hover: hover}')
			visual.icon(v-if='tout.imgs.icon.l'
				background=''
				:load='true'
				:image='tout.imgs.icon.l')
			.content
				.headline(v-if='tout.headline' v-html='tout.headline')
				.copy(v-if='tout.copy' v-html='tout.copy')
				a.learn-more(v-if='tout.cta') {{ tout.cta }}

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default
	props: ['tout', 'layout','hover']
</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>
.icon-tout
	display flex

	.link-container
		flex 1 0 auto
		height 100%

		.stager &
			flex 1 0 auto

	&.horizontal
		flex-direction row

	&.vertical
		flex-direction column

u
	text-decoration underline

.headline
	wysiwyg-copy()

.copy
	bullet-copy()

.icon
	display flex
	flex-shrink 0
	justify-content center
	align-items center
	aspect-ratio(1)
	>>>img
		width 100%

// Place the padding on the wrapper vs .icon-tout class for hover effect
@media (min-width S)
	.hover
		transform-origin top left
		transition transform 300ms ease-out !important
		-webkit-backface-visibility hidden
		transform scale(1) translateZ(0)
		will-change transform
		outline none
		border none
		// -webkit-font-smoothing subpixel-antialiased !important
		&:hover
			transform scale(1.015) translateZ(0)


</style>
