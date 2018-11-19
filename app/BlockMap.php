<?php

namespace App;

use App\Concerns\IsBlockType;
use Bkwld\Decoy\Models\Base;

class BlockMap extends Base
{
    use IsBlockType;

    /**
     * Map block data for the API
     *
     * @param  Block $block
     * @return array
     */
    public function forApi(Block $block) {
        $block->load([
            'locations' => function($query) { $query->listing(); },
        ])->addVisible('locations');
        return $this->toArray();
    }
}
