<?php

namespace App\Concerns;

// Deps
use App\Block;

/**
 * Models that have blocks
 */
trait HasBlocks
{
    /**
	 * Return the list of relations on this model that should be cloned
	 *
	 * @return  array
	 */
	public function getCloneableRelations() {
		return array_merge($this->cloneable_relations ?? [], ['blocks']);
	}

    /**
     * List of blocks
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blocks()
    {
        return $this->morphMany(Block::class, 'blockable');
    }
}
