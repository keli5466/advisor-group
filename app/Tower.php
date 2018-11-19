<?php

namespace App;

// Deps
use App\Concerns\HasBlocks;
use App\Concerns\SiteSpecific;
use Bkwld\Decoy\Models\Base;
use Bkwld\Decoy\Models\Traits\HasImages;

class Tower extends Base
{
    use HasImages, SiteSpecific, HasBlocks;

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'route';
    }

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
    protected $visible = ['title', 'description', 'blocks'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return ['route' => [
            'source' => 'title'
        ]];
    }

    /**
     * Make sure the route is valid
     *
     * @param Illuminate\Validation\Validator $validator
     */
    public function onValidating($validator) {

        // Clean up the route
        $this->route = preg_replace('#[^\w-/]#', '',
            str_replace(' ', '-', $this->route));

        // Update the rules to exclude the current route
        $site = ',site,'.app('site')->slug;
        $rule = $this->id ?
            'unique:towers,route,'.$this->id.',id'.$site :
            'unique:towers,route,NULL,id'.$site ;
        $validator->addRules([ 'route' => $rule ] );
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
        $query->orderBy('title');
    }

    /**
     * Return the URI to instances of this model
     *
     * @return string A URI that the browser can resolve
     */
    public function getUriAttribute()
    {
        if ($this->route == 'home') return url('/');
        return app('site')->url($this->route);
    }
}
