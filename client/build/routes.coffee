# Deps
api = require('../plugins/axios')( env: process.env )
module.exports = {}

# Build the list of all routes for generating static files
module.exports.forGenerate = ->

	# Simple routes
	routes = [
		'/'
	]

	# Get a list of all Decoy routes for the current site
	routes = routes.concat (await api.get('routes')).data

	# Remove the /home route
	routes = routes.filter (route) -> route != '/home'

	# Return list of routes
	return routes

# Flatten this object to an array of paths for use by the sitemap module
module.exports.forSitemap = -> await module.exports.forGenerate()
