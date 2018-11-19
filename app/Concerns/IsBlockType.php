<?php

namespace App\Concerns;

// Deps
use App\Block;

/**
 * Shared block model traits
 */
trait IsBlockType {

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
     * Get the singular-named table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        if (isset($this->table)) return $this->table;
        return str_replace('\\', '', snake_case(class_basename($this)));
    }

    /**
     * The attributes that should not show up in array conversion
     *
     * @return array
     */
    public function getHidden() {
        return ['id', 'block_id', 'created_at', 'updated_at', 'images'];
    }

    /**
     * Convert to array for the api, this is designed to be overidden to add
     * image transforms
     *
     * @param  Block $block
     * @return array
     */
    public function forApi(Block $block) {
        return $this->toArray();
    }

}
