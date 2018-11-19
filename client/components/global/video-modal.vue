<!--
Render a list of blocks
-->

<template lang='pug'>

.video-modal
	transition(name='fade')
		.modal(v-show='active')
			.overlay(@click='closeModal')
			transition(name='slide-fade')
				.video-embed(:id='video' v-show='active'
					:class='direction')
					script(type='text/javascript'
						:id='"vidyard_embed_code_"+video'
						:src='"//play.vidyard.com/"+video+".js?v=3.1.1&type=inline"')

					//- Import API to Query

					script(type='text/javascript'
						:src="'//play.vidyard.com/v0/api.js'")

					//- Close
					.close(@click='closeModal' ref='close')


</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>

	export default
		props: ['video','active','direction']


		data: ->
			# active :
			videoPlayer: null
			thisvideo : @video

		methods:

			closeModal: ->
				video = new (Vidyard.player)(@thisvideo)
				video.pause()
				@active = false
</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.overlay
	position fixed
	top 0
	right 0
	width 100%
	z-index 15
	height 100%
	background rgba(250,250,250,0.7)
	transition opacity 1s ease



.video-embed
	z-index 16
	transition transform .7s easeOutQuart
	position absolute
	top 0
	right 0
	@media (min-width XL-max)
		right gutter-wide
	width 100%
	max-width rem(853px)
	height 100%
	&.image-left
		left 0
		@media (min-width XL-max)
			left gutter-wide
// Makes player responsive
>>>.vidyard_player > span
	width 100% !important
	height 100% !important


.video-modal
	position absolute
	top 0
	right 0
	height 100%
	width 100%

.modal
	width 100%
	height 100%
	top 0
	position absolute
	right 0
	z-index 8

.close
	width rem(40px)
	height @width
	right 5px
	top 5px
	display flex
	justify-content center
	align-items center
	position absolute
	border-radius 50%
	background rgba(255, 255, 255, 0.8)
	&:after
		content '\00d7' //unicode X
		font-family sans-serif
		font-weight 300
		font-size rem(30px)
		margin-bottom 4px // eyeball centering 

	&:hover
		cursor pointer
		transform opacity 300ms ease
		opacity 0.8




</style>
