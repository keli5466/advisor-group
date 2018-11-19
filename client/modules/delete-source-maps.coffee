###
Delete source maps after assets built (and after they have been pushed to
Sentry) so they don't get deployed.
https://github.com/getsentry/sentry-webpack-plugin/issues/56
###
rimraf = require 'rimraf'
module.exports = ->
	@nuxt.hook 'build:done', ->
		rimraf.sync "#{__dirname}/../../.nuxt/dist/*.js.map"
