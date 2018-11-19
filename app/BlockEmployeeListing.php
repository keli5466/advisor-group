<?php

namespace App;

use App\Concerns\IsBlockType;
use Bkwld\Decoy\Models\Base;
use Bkwld\Decoy\Models\Traits\HasImages;

class BlockEmployeeListing extends Base
{
    use HasImages, IsBlockType;

    /**
     * Map block data for the API
     *
     * @return array
     */
    public function forApi(Block $block) {
        $block->withImage('employee_listing_background');
        return array_merge($this->toArray(), [
            'employees' => \App\Employee::listing()->get()
                ->withImage('image', '100%')
                ->withImage('listing', '100%')
                ->toArray()
        ]);
    }
}
