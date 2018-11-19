<?php

namespace App;

use App\Concerns\IsBlockType;
use Bkwld\Decoy\Models\Base;
use Bkwld\Decoy\Models\Traits\HasImages;

class BlockFullBleedCta extends Base
{
    use HasImages, IsBlockType;

    /**
     * Map block data for the API
     *
     * @return array
     */
    public function forApi(Block $block) {
        $block->withImage('full_bleed_cta_background');
        return $this->toArray();
    }
}
