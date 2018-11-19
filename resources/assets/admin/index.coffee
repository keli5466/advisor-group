# Load Decoy js from the public/assets directory where it was installed by
# `php artisan vendor:publish`
decoy = require '~~/public/assets/decoy/index'

# Make a single stylesheet with Decoy and extended styles
require '~~/public/assets/decoy/index.css'

# Add site-selector
require './site-selector.coffee'
require './site-selector.styl'

# Recator plugins
require './plugins/video.js'

# Customize wysiwyg options
decoy.wysiwyg.config.allowUploads()
decoy.wysiwyg.config.merge
	deniedTags: [ 'style' ]
	plugins: ['video']
	buttons: ['underline', 'bold', 'italic', 'link', 'file', 'image', 'horizontalrule', 'orderedlist', 'unorderedlist', 'video', 'html']

# Start up decoy
decoy.init()
