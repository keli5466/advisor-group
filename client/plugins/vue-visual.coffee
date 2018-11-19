Vue = require 'vue'
# require('vue-visual/index.css')
Vue.component('visual', require 'vue-visual').options.setDefaults
	background: 'cover'
	load: 'visible'
	loadPoster: true
	transition: 'vv-fade'
