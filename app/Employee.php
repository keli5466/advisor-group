<?php

namespace App;

use App\Concerns\SiteSpecific;
use Bkwld\Decoy\Models\Base;
use Bkwld\Decoy\Models\Traits\HasImages;

class Employee extends Base
{
    use HasImages, SiteSpecific;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
       'name' => 'required',
       'images.image' => 'image|required',
       'images.listing' => 'image|required',
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['name', 'description', 'job_title'];

    /**
     * Put new instances at the end
     *
     * @return void
     */
    public function onCreating()
    {
        if (isset($this->position)) return;
        $this->position = static::max('position') + 1;
    }

    /**
     * Orders instances of this model in the admin as well as default ordering
     * to be used by public site implementation.
     *
     * @param  Illuminate\Database\Query\Builder $query
     * @return void
     */
    public function scopeOrdered($query)
    {
        $query->positioned();
    }
}
