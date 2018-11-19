
<template lang='pug'>
	.firms
		a.icon-fsc(href='https://www.fscsecurities.com')
		a.icon-raa(href='https://www.royalalliance.com')
		a.icon-spf(href='https://www.sagepointfinancial.com')
		a.icon-wfs(href='https://www.woodburyfinancial.com')

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

.firms
	max-width 1000px
	display flex
	margin-h auto
	flex-wrap wrap
	justify-content space-between
	font-size 4vw
	color white
	@media (min-width max-w)
		font-size rem(60px)

	@media (max-width mobile)
		justify-content center
		margin-v rem(40px)
		div
			width 50%
			text-align center
			margin-bottom 20px

// adjust WFS size to match others
.icon-wfs
	font-size rem(50px)

	&:before
		vertical-align sub

.icon-spf
	font-size rem(65px)


</style>
