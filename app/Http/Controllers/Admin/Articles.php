<?php

namespace App\Http\Controllers\Admin;

use Bkwld\Decoy\Controllers\Base;

class Articles extends Base
{
    protected $title = 'Articles';

    protected $description = 'News or Resources articles that can be gated and have <b>Blocks</b>.';

    protected $columns = [
        'Title' => 'getAdminTitleHtmlAttribute',
        'Abstract' => 'abstract',
        'Type' => 'type',
    ];
    protected $search = [
        'title',
        'abstract',
        'type',
    ];

}
