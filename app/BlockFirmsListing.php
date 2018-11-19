<?php

namespace App;

use App\Concerns\IsBlockType;
use Bkwld\Decoy\Models\Base;
use Bkwld\Decoy\Models\Traits\HasImages;

class BlockFirmsListing extends Base
{
    use HasImages, IsBlockType;

    public static $layouts = [
        'minimal' => 'Minimal',
        'expanded' => 'Expanded',
    ];

    /**
     * Map block data for the API
     *
     * @return array
     */
    public function forApi(Block $block) {
        $block->withImage('firms_listing_background');
        return array_merge($this->toArray(), [
            'firms' => \App\Firm::listing()->get()
                ->withImage('background')
                ->withImage('dark_logo', '100%')
                ->withImage('light_logo', '100%')
                ->toArray()
        ]);
    }
}
