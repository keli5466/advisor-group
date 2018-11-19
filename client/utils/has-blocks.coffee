###
DRY up shared tower code
###

# List of block components
blocks =
	anchorLinks: require '~/components/blocks/anchor-links'
	centeredCallout: require '~/components/blocks/centered-callout'
	contactForm: require '~/components/blocks/contact-form'
	copyAndImage: require '~/components/blocks/copy-and-image'
	copyAndIconBulletPoint: require '~/components/blocks/copy-and-icon-bullet-point'
	employeeListing: require '~/components/blocks/employee-listing'
	firmsListing: require '~/components/blocks/firms-listing'
	fullBleedCta: require '~/components/blocks/full-bleed-cta'
	iconToutsAndImage: require '~/components/blocks/icon-touts-and-image'
	imageAndCta: require '~/components/blocks/image-and-cta'
	locationMap: require '~/components/blocks/map'
	marquee: require '~/components/blocks/marquee'
	multiBlurb: require '~/components/blocks/multi-blurb'
	newsListing: require '~/components/blocks/news-listing'
	resourcesListing: require '~/components/blocks/resources-listing'
	twoColumnCtas: require '~/components/blocks/two-column-ctas'
	twoColumnIconTouts: require '~/components/blocks/two-column-icon-touts'
	valueProps: require '~/components/blocks/value-props'
	wysiwyg: require '~/components/blocks/wysiwyg'

export keys = Object.keys blocks

# The mixin that tower-like pages use
export mixin =

	# Block components
	components: blocks

# Allows blocks to load extra data during asyncData phase
export loadBlockData = (context, towerBlocks = [], extra) ->
	Promise.all towerBlocks.map (block) ->
		type = block?.type
		if func = blocks[type]?.asyncData
		then func(context, block, extra)
		else Promise.resolve()
