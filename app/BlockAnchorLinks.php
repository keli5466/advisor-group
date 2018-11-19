<?php

namespace App;

use App\Concerns\IsBlockType;
use Bkwld\Decoy\Models\Base;

class BlockAnchorLinks extends Base
{
    use IsBlockType;

    /**
     * Map block data for the API
     *
     * @return array
     */
    public function forApi(Block $block) {
        $block->load([
            'links' => function($query) { $query->listing(); },
        ])
        ->addVisible('links');
        return $this->toArray();
    }
}
