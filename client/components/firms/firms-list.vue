<!--
The expanded firms listing
-->

<template lang='pug'>

.firms-list
	.eyebrow Jump To A Firm
	.firm-anchors.stager(v-in-viewport.once)
		.firm-anchor(v-for='firm in firms')
			a(@click='scrollDown(firm.name)')
				visual.logo(v-if='firm.imgs.dark_logo.l'
					:image='firm.imgs.dark_logo.l'
					:load='true'
					background='')

	.firms
		.firm.corner-card.fade-in(v-in-viewport.once v-for='firm in firms' :id='firm.name')
			.image
				visual.background(v-if='firm.imgs.background.l'
					:load='true'
					:image='firm.imgs.background.l')
				visual.foreground(v-if='firm.imgs.light_logo.l'
					:load='true'
					:image='firm.imgs.light_logo.l'
					background='')

			.cta
				.description(v-if='firm.description' v-html='firm.description')
				a.outline-btn(v-if='firm.url' :href='firm.url') {{ firm.cta }}

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
import animateScrollTo from 'animated-scroll-to'
export default
	props: ['firms']


	methods:
		scrollDown:  (test) ->
			scrollId = document.getElementById(test)
			animateScrollTo scrollId, speed: 1150, offset: -80

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

// moved this to the parent component
.firms-list
	background light-grey

.eyebrow
	display block
	text-align center
	padding-top rem(40px)
	padding-bottom rem(20px)
	eyebrow-title()

.firm-anchors
	display flex
	justify-content space-between
	align-items center
	margin 0 page-margin rem(50px)
	@media (max-width tablet)
		flex-wrap wrap
		margin-h h-pad-mobile

.foreground
	width 50%
	text-align center

.firm-anchor
	cursor pointer
	width 20%
	text-align center
	@media (max-width tablet)
		width 50%
		padding-top rem(20px)
		padding-h h-pad-mobile

.logo
	width 100%

.firm:nth-child(even)
	flex-direction row-reverse
	@media (max-width tablet)
		flex-direction column

.firm
	position relative
	display flex
	justify-content space-between

	@media (max-width tablet)
		flex-direction column

	// switch left to right

	// button colors
	&:nth-child(1)
		.cta .outline-btn
			color #f7bc16
	&:nth-child(2)
		.cta .outline-btn
			color #1c2558
	&:nth-child(3)
		.cta .outline-btn
			color #5d215f
	&:nth-child(4)
		.cta .outline-btn
			color #84c446

	&:not(:last-of-type)
		margin-bottom rem(50px)

.image
	position relative
	display block
	width 50%
	@media (max-width tablet)
		width 100%
		aspect-ratio(4/3)



.background
	position absolute
	top 0
	left 0
	width 100%
	height 100%

.foreground
	center()


.outline-btn
	padding rem(18px) 15%
	width auto
	text-align center
	button-style()
	z-index 1
	&:before
		background-color alpha(silver, 0.2)!important //override
	@media (max-width tablet)
		margin rem(5px) auto rem(10px)
		width 100%


.cta
	width 50%
	background white
	padding rem(60px) rem(40px) rem(60px) rem(70px)
	@media (max-width tablet)
		width 100%
		padding gutter-mobile


>>> .description

	p
		font 'regular', 22px, charcoal-grey
		line-height rem(35px)
		padding 0
		margin 0

	ul
		font 'prox', 16px, grey
		list-style none
		border-left 1px solid silver
		padding-left rem(27px)
		margin-left rem(40px)
		line-height rem(28px)
		margin-v rem(45px)
		font-weight 300
		@media (max-width tablet)
			margin-v rem(20px)
			margin-left 0
			padding-left 0
			border-left 0


	b
		font-weight 500

</style>
