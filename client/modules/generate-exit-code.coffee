# On a generate fail, return a non-0 exit code so Netlify won't deploy the build
module.exports = ->
	@nuxt.hook 'generate:done', (generator, errors) ->
		process.exit(1) if errors.length
