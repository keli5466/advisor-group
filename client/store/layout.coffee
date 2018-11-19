
export state = -> 
	backgroundedHeader: false

export mutations =

	# Set a key/val pair
	set: (state, pair ) -> state[key] = val for key, val of pair
			
