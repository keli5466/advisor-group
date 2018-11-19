<?php

namespace App\Concerns;

// Deps
use App\Block;

/**
 * Shared block model traits
 */
trait IsPositionedBlockChild {

    /**
     * Marquee block
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    /**
     * Put new instances at the end
     *
     * @return void
     */
    public function onCreating()
    {
        if (isset($this->position)) return;
        $this->position = static::where('block_id', $this->block_id)
            ->max('position') + 1;
    }

    /**
     * Orders instances of this model in the admin as well as default ordering
     * to be used by public site implementation.
     *
     * @param  Illuminate\Database\Query\Builder $query
     * @return void
     */
    public function scopeOrdered($query)
    {
        $query->positioned();
    }
}
