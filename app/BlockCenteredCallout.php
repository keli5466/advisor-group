<?php

namespace App;

use App\Concerns\IsBlockType;
use Bkwld\Decoy\Models\Base;

class BlockCenteredCallout extends Base
{
    use IsBlockType;

    public static $slashes = [
        'right' => 'Right',
        'left' => 'Left',
    ];

    /**
     * Map block data for the API
     *
     * @return array
     */
    public function forApi(Block $block) {
        return $this->toArray();
    }
}
