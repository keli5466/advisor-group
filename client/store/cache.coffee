###
Fetch Eloqua form data once and re-use it in the future
###

import makeApi from '../plugins/axios'

export state = -> store: {}

export mutations =

	# Store data for futrue
	cache: ({ store }, { key, data }) -> Vue.set store, key, data

export actions =

	# Get some data from server if we haven't cached or return the cached data
	get: ({ commit, state, rootState }, path) ->
		return data if data = state.store[path]
		api = makeApi env: rootState.env
		try
			{ data } = await api.get path
			commit 'cache', { key: path, data }
			return data
		catch e then console.error e
