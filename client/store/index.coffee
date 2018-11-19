
export state = -> env: null

export mutations =

	# Store API
	setEnv: (state, env ) -> state.env = env

export actions =

	# Store the API instance for other modules to use
	nuxtServerInit: ({ commit }, { env }) -> commit 'setEnv', env
