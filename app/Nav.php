<?php

namespace App;

use App\Concerns\SiteSpecific;
use Bkwld\Decoy\Models\Base;

class Nav extends Base
{
    use SiteSpecific;

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'slug' => 'alpha_dash|unique:navs',
    ];

    /**
     * List of all relationships
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function navRootLinks()
    {
        return $this->hasMany(NavRootLink::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return ['slug' => [
            'source' => 'name'
        ]];
    }
}
