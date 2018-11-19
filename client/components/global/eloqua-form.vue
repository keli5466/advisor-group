<!--
The eloqua form
-->

<template lang='pug'>

.eloqua-form
	form(ref='form')
		template(v-for='field in fields')


			label(:class='field.name') {{ field.label }}

			input(v-if='field.type == "text"'
				type='text'
				id='field.id'
				:class='field.name'
				required
				v-model='form[field.name]')

			template(v-else-if='field.type == "checkbox"')
				.horizontal-line
				template(v-for='(option, key) in field.options')
					label.checkbox-container
						input(type='checkbox'
							:value='key'
							:id='field.id'
							v-model='form[field.name]')
						span.checkmark
						.label {{ option }}
			.select(v-else-if='field.type == "singleSelect"')
				select(
					:id='field.id'
					placeholder='Please Select One'
					v-model='form[field.name]')
					option(v-for='(option, index) in field.options'
						v-html='option')

			.btn-fill.submit(v-else-if='field.type == "submit"'
				@click='submitForm'
				type='submit'
				:class='[{loading : submitting},{ loaded : success}]'
				value='Submit'
				:id='field.id')
					.spinner-check
					input.hidden(type='submit')

		.feedback
				.success(:class='{ visible : success}') {{ successMessage }}
		.bottom-links
			p Looking for job at {{site|| ''}} Advisor Group? Visit our 
				a(href='https://careers.advisorgroup.com/' target='_blank') careers site
				|.
			p If you're a client and need help with your account, please contact your financial advisor.

</template>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script lang='coffee'>
zipObject = require 'lodash/zipObject'
mapValues = require 'lodash/mapValues'
isArray = require 'lodash/isArray'
export default
	props: ['type', 'fields', 'successMessage']

	data: ->
		submitting: false
		success: false
		form: {}


	watch: fields:
		immediate: true

		handler: (fields) ->
			#Map through block.form to set initial form state
			names = @fields.map (form) -> form.name
			empties = @fields.map (form) -> switch form.type
				when 'singleSelect' then Object.values(form.options)[0]
				when 'checkbox' then []
				else ''
			@form = zipObject names, empties





	computed:
		site: ->
			if process.env.SITE_SLUG == 'raa'
				return 'Royal Alliance /'
			if process.env.SITE_SLUG == 'wfs'
				return 'Woodbury /'
			if process.env.SITE_SLUG == 'spf'
				return 'SagePoint /'
			if process.env.SITE_SLUG == 'fsc'
				return 'FSC /'

		mappedForm: -> mapValues @form, (val) -> switch
			when isArray val then val.join ','
			else val


	methods:
		submitForm: (e) ->
			@success = false
			return if !@.$refs.form.checkValidity()

			e.preventDefault()

			return if @submitting
			@submitting = true
			try response = await @$api.post "form/#{@type}", @mappedForm
			catch error then return console.error error.response.data
			finally
				@success = true
				@submitting = false

			@setStorage()

		setStorage: ->
			if localStorage.hasSubscribedToResources then return
			if @type == 'resources'
				localStorage.hasSubscribedToResources = 'true'
				window.location.reload(true)


</script>

<!-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– -->

<style lang='stylus' scoped>

// .ResourceName
// 	display none !important

label
	font 'prox', 19px, black
	display block
	margin-top rem(15px)
	&:nth-child(-n+7)
		&:after
			content '*'
			blockThemeColor color
			margin-left 5px
	&:first-of-type
		&:before
			content '* Required'
			float right
			blockThemeColor color

.require
	position absolute
	top 0

// hidden input{submit} that lies over the stlyed button
.hidden
	width 100%
	height 100%
	position absolute
	opacity 0
	z-index 12
	left 0
	top 0


// CHECK BOX
.checkbox-container
	display flex
	align-items center
	position relative
	padding-left 55px
	margin-top rem(25px)
	cursor pointer
	font-size 18px
	height 20px
	user-select none
	&:first-child
		color blue
		border-top 1px solid grey
	.label
		opacity 0.6
		&:hover
			opacity 1
	input
		opacity 0
		position absolute
		cursor pointer
		&:checked
			~ .label
				opacity 1
			~ .checkmark:after
				display block
			~ .checkmark
				opacity 1

	.checkmark
		position absolute
		top 0
		left 0
		height 25px
		width 25px
		box-shadow inset 0 1px 3px 0 #f4f4f4
		background-color #ffffff
		border solid 1px silver
		&:after
			content ''
			position absolute
			display none
			left 10px
			bottom 5px
			height rem(29px)
			width rem(13.7px)
			border-style solid
			blockThemeColor border-color
			border-width 0 2px 2px 0
			transform rotate(45deg)

.horizontal-line
	margin-top 15px
	border-bottom 1px solid silver


// LOADING SPINNER
.spinner-check
	border 1px solid rgba(300,300,300,0.3)
	border-left-color white
	border-radius 100%
	height rem(45px)
	width rem(45px)
	z-index 2
	display inline-block
	transform-origin center center
	opacity 0
	.loading &
		opacity 1
		animation spinner 1s infinite linear
	.loaded &
		opacity 1
		animation none
		border-color rgba(300,300,300,0.6)
		transition border 500ms ease-out 200ms

// Submit BTN
.submit
	margin-top rem(30px)
	outline none
	blockThemeColor background
	appearance initial
	display flex
	align-items center
	justify-content center
	font 'prox', 16px, white
	font-weight bold
	width rem(320px)
	letter-spacing 2px//help text look like prox-extrabold
	height rem(60px)
	border none
	text-transform uppercase
	@media (max-width mobile)
		width 100%

.submit
	position relative
	&:after
		content 'Submit'
		z-index 2
		position absolute
		left 50%
		top 50%
		transform translate(-50%,-50%)

	&:before
		blockThemeColor background-color, .88
		position absolute
		top 0
		left 0
		right 0
		z-index 1
		height 0
		width 100%
		content ''
		transition height .25s ease
		background-position center top

	&:hover
		&:before
			height 100%
			transition height .25s ease

.loading
	&:after
		content ''

.loaded
	&:after
		animation checkmark 500ms ease-out
		transform scaleX(-1) rotate(135deg)
		opacity 1
		height rem(24px)
		width rem(12px)
		transform-origin right center
		border-right 1.5px solid white
		border-top 1.5px solid white
		content ''
		left auto
		top auto
		position absolute


@keyframes spinner
	0%
		transform rotate(0deg)
	100%
		transform rotate(360deg)

select::-ms-expand
		display none

@keyframes checkmark
	0%
		height 0
		width 0
		opacity 0

	20%
		height 0
		width rem(12px)
		opacity 0.2

	40%
		height rem(24px)
		width rem(12px)
		opacity 0.4

	100%
		height rem(24px)
		width rem(12px)
		opacity 1


.feedback
	margin rem(20px) auto 0
	font 'prox', 16px, black
	font-weight 600
	.success
		opacity 0
		transition opacity t-time ease
		&.visible
			opacity 1


input[type='text']
select
	display block
	margin rem(10px) 0 rem(15px)
	border-radius 0
	-webkit-appearance none
	padding rem(11px) rem(14px)
	font 'prox', 18px, grey
	background white
	border-color silver
	width 100%

input::placeholder
	font-size 18px
	line-height 1.25
	font-weight 300

input[type='checkbox']
.checkbox
	-webkit-appearance checkbox
	appearance normal
	width auto

	&:checked
		background blue

.select
	position relative
	&:after
		position absolute
		content ''
		right 5%
		top calc(50% - 3px)
		transform translateY(-50%)
		transform rotate(0)
		border-top 6px solid grey
		border-left 6px solid transparent
		border-right 6px solid transparent


label:last-of-type
	display none

.bottom-links p
	font 'prox', 16px, black
	display block
	margin-top rem(15px)
	line-height 20px

	a
		blockThemeColor color
		text-decoration underline




</style>
