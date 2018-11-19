<?php

namespace App;

use Bkwld\Decoy\Models\Base;

class NavRootLink extends Base
{

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
       'title' => 'required',
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['title', 'url'];

    /**
     * List of all relationships
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function nav()
    {
        return $this->belongsTo(Nav::class);
    }

    public function navChildLinks()
    {
        return $this->hasMany(NavChildLink::class);
    }

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

    /**
     * Map block data for the API
     *
     * @return array
     */
    public function forApi() {
        return array_merge($this->toArray(), [
            'navChildLinks' => $this->navChildLinks()->listing()->get()
                ->toArray()
        ]);
    }
}
