<!--
The global footer
-->

<template lang='pug'>

footer
	.inner-max-w
		.top-nav(:class='{ag : ag}' v-parse-anchors)
			.main-logo
				a.brand-logo(href='/'
					:class='logo')

			firms(v-show='ag')

			ul.footer-nav
				li
					a(href='https://careers.advisorgroup.com/' target='_blank') Careers
				li
					a(href='/contact') Contact Us
				li
					a(href='/terms-of-use') Terms of Use
				li(v-if='other')
					a(href='/registration-center') Registration Center
				li
					a(href='/disclosures') Disclosures
				li
					a(href='http://response.advisorgroup.com/PrivacyNotice' target='_blank') Privacy Notice Response
				li.social-links
					a.icon-facebook(:href='facebook' target='_blank')
					a.icon-twitter(href='https://twitter.com/advisorgroupbds?lang=en' target='_blank')
					a.icon-podcast(href='/podcasts')
					a.icon-linkedin(:href='linkedin' target='_blank')

		hr
		p.terms Securities and investment advisory services are offered through Advisor Group, Inc. subsidiaries, FSC Securities Corporation, Royal Alliance Associates, Inc., SagePoint Financial, Inc. and Woodbury Financial Services, Inc., broker-dealers, registered investment advisors and members of
			a(href='http://www.finra.org/' target='_blank')   FINRA
			|   and
			a(href='https://www.sipc.org/' target='_blank')   SIPC.
		p.terms 	PLEASE NOTE: The information being provided is strictly as a courtesy. When you link to any of the web sites provided here, you are leaving this web site. We make no representation as to the completeness or accuracy of information provided at these web sites.

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
export default

	components: 'firms': require '~/components/global/firms'

	data: ->
		ag: null
		other: null
		facebook: null
		linkedin: null

	computed:
		logo: -> return 'icon-' + process.env.SITE_SLUG

	mounted: ->
		@findSite()
		@setSocial()

	methods:
		findSite: ->
			if process.env.SITE_SLUG == 'ag'
				@ag = true
			else
				@other = true

		setSocial: ->
			if process.env.SITE_SLUG == 'ag'
				@facebook = 'https://www.facebook.com/AdvisorGroupBDs/'
				@linkedin = 'https://www.linkedin.com/company/advisor-group'
			if process.env.SITE_SLUG == 'wfs'
				@facebook = 'https://www.facebook.com/woodburyfinancialservicesinc/'
				@linkedin = 'https://www.linkedin.com/company/woodbury-financial-services?trk=similar-companies_org_title'
			if process.env.SITE_SLUG == 'spf'
				@facebook = 'https://www.facebook.com/SagePointFinancial/'
				@linkedin = 'https://www.linkedin.com/company/sagepoint-financial_2?trk=similar-companies_org_title'
			if process.env.SITE_SLUG == 'raa'
				@facebook = 'https://www.facebook.com/RoyalAllianceAssociates/'
				@linkedin = 'https://www.linkedin.com/company/royal-alliance-associates-inc?trk=similar-companies_org_title'
			else if process.env.SITE_SLUG == 'fsc'
				@facebook = 'https://www.facebook.com/FSCSecurities/'
				@linkedin = 'https://www.linkedin.com/company/fsc-securities?trk=similar-companies_org_title'

</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

footer
	background #2c3032
	color white
	padding-v( rem(40px))
	@media (max-width tablet)
		padding-bottom rem(10px)

.main-logo
	text-align center
	font-size rem(85px)

	.ag &
		margin-h(auto)
		margin-bottom 0

	@media (max-width tablet)
		font-size rem(100px)
		width 100%
		margin-bottom rem(50px)


.top-nav
	display flex
	flex-direction row
	flex-wrap wrap
	align-items center
	margin-bottom rem(20px)

	@media (max-width tablet)
		margin-bottom 0

	&:not(.ag)
		.icon-twitter
			display none
		@media (min-width tablet)
			.social-links
				margin-top 15px
				margin-right auto !important
			.footer-nav li
				margin-top 15px
				margin-right 15px

.footer-nav
	display flex
	margin-h(auto)
	flex-wrap wrap
	flex 0 1 800px
	width 100%

	.ag &
		flex-basis 800px
		margin-h (auto)
		.social-links
			@media (max-width desktop)
				width 100%
				margin-top 20px
				text-align center

	padding 0
	justify-content space-between
	list-style-type none
	@media (min-width M)
		margin-left auto
		margin-right 0

	a
		font 'prox', 16px, white
		font-size 16px, true
		letter-spacing 1px
		margin 0 auto

	.social-links a:not(:last-of-type)
		margin-right rem(15px)

	@media (max-width tablet)
		flex-direction column
		text-align center
		li
			margin-bottom 25px

		.social-links a
			font-size 30px, true
			display inline-block

			&:not(:last-of-type)
				margin-right rem(30px)


>>>.firms
	width 80%
	margin-v rem(60px)

	@media (max-width tablet)
		width 100%
		a
			width 50%
			font-size 40px, true
			text-align center
			&:nth-child(-n+2)
				padding-bottom 20px

// horizontal line
hr
	border none
	height 1px
	background grey

.terms
	margin rem(15px) rem(70px)
	text-align center
	font 'prox', 12px, grey
	font-size 12px, true
	line-height 1.5
	a
		font-weight bold
	@media (max-width tablet)
		margin rem(10px) auto
		text-align justify



</style>
