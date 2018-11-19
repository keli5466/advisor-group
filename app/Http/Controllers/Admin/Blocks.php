<?php

namespace App\Http\Controllers\Admin;

use Bkwld\Decoy\Controllers\Base;

class Blocks extends Base
{
    protected $title = 'Blocks';

    protected $description = 'The parts that make up a tower.';

    protected $columns = [
        'Title' => 'getAdminTitleHtmlAttribute',
        'Type' => 'getAdminTypeAttribute',
    ];
}
