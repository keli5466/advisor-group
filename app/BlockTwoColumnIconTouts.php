<?php

namespace App;

use App\Concerns\IsBlockType;
use Bkwld\Decoy\Models\Base;

class BlockTwoColumnIconTouts extends Base
{
    use IsBlockType;

    public static $themes = [
        'white' => 'White',
        'grey' => 'Grey',
    ];

    /**
     * Map block data for the API
     *
     * @return array
     */
    public function forApi(Block $block) {
        $block->load([
            'iconTouts' => function($query) { $query->listing(); },
        ])
        ->withImage('iconTouts.icon', 250)
        ->addVisible('iconTouts');
        return $this->toArray();
    }
}
