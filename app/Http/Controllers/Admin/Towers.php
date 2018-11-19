<?php

namespace App\Http\Controllers\Admin;

use Bkwld\Decoy\Controllers\Base;

class Towers extends Base
{
    protected $description = 'Pages comprised of many <b>Blocks</b> but no inherent structure.';

    protected $columns = [
        'Title' => 'title',
        'Route' => 'route',
        // 'Blocks' => 'getBlocksCountLabelAttribute',
    ];
    protected $search = [
        'title',
        'route',
    ];

    // Show more per page than normal
    static public $per_page = 40;
}
