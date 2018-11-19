###
General page helpers
###

# Standard 404 object
export parseError = (error) ->
	switch status = error?.response?.status
		when 404
			statusCode: 404
			message: 'Page not found'
		else
			statusCode: status || 500
			message: error?.message || error || 'Unknown error'

# Simpliy calls to set SEO head fields
export seo = ({ title, description, image }) ->
	title: title
	meta: [
		{
			hid: 'og:title'
			property: 'og:title'
			content: title
		} if title
		{
			hid: 'description'
			name: 'description'
			content: description
		} if description
		{
			hid: 'og:image'
			property: 'og:image'
			content: image
		} if image
	].filter (v) -> !!v # Remove empties
