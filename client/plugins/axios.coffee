axios = require 'axios'
module.exports = ({ env }, inject = null) ->

	# Make the API endpoint, adding a trailing slash if necessary
	apiEndpoint = env.API_URL.replace '${SITE_SLUG}', env.SITE_SLUG
	apiEndpoint += '/' unless apiEndpoint.match /\/$/

	# Create API client with defaults
	client = axios.create
		baseURL: apiEndpoint
		headers: 'X-Site-Slug': env.SITE_SLUG

	# Inject the client into the Nuxt app
	inject 'api', client if inject

	# Return the client, for use outside of Nuxt
	return client
