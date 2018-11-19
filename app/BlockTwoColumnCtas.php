<?php

namespace App;

use App\Concerns\IsBlockType;
use Bkwld\Decoy\Models\Base;

class BlockTwoColumnCtas extends Base
{
    use IsBlockType;

    public static $layouts = [
        'single' => 'Single Card',
        'separate' => 'Separate Cards',
    ];

    /**
     * Map block data for the API
     *
     * @return array
     */
    public function forApi(Block $block) {
        $block->load([
            'ctaCards' => function($query) { $query->listing(); },
        ])->addVisible('ctaCards');
        return $this->toArray();
    }
}
