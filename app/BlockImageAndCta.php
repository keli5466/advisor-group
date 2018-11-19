<?php

namespace App;

use App\Concerns\IsBlockType;
use Bkwld\Decoy\Models\Base;

class BlockImageAndCta extends Base
{
    use IsBlockType;

    public static $layouts = [
        'image-left' => 'Image Left',
        'image-right' => 'Image Right',
    ];

    /**
     * Map block data for the API
     *
     * @return array
     */
    public function forApi(Block $block) {
        $block->load([
            'ctaCards' => function($query) { $query->listing(); },
        ])
        ->withImage('image_and_cta_image', 600)
        ->addVisible('ctaCards');
        return $this->toArray();
    }
}
