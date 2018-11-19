<?php

namespace App;

use App\Concerns\IsBlockType;
use Bkwld\Decoy\Models\Base;
use Bkwld\Decoy\Models\Traits\HasImages;

class BlockContactForm extends Base
{
    use HasImages, IsBlockType;

    /**
     * Map block data for the API
     *
     * @return array
     */
    public function forApi(Block $block) {
        $block->withImage('contact_form_background', 600);
        return $this->toArray();
    }
}
