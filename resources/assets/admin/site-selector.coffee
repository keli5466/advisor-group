# Get reference to jquery
decoy = require '~~/public/assets/decoy/index'
$ = decoy.$

# Redirect to site-setting route with user selection
$el = $('.site-selector')
$menu = $el.find('select').on 'change', ->

	# Change label shown to users
	$el.find('.current').text('Switching...')

	# Redirect
	window.location.href = "/admin/site/#{$menu.val()}"
