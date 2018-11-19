<?php

namespace App;

use App\Concerns\SiteSpecific;
use Bkwld\Decoy\Models\Element as BaseElement;
use Illuminate\Database\Eloquent\Builder;

/**
 * Subclass of Decoy's element class to make it site specific
 */
class Element extends BaseElement
{
    use SiteSpecific;

    /**
     * Enforce the composite key while saving. Element has a composite primary
     * key accross `key` and `locale` AND, for this site, `site`
     * https://github.com/laravel/framework/issues/5355
     *
     * @param  Illuminate\Database\Eloquent\Builder  $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery(Builder $query)
    {
        parent::setKeysForSaveQuery($query);
        $this->site = app('site')->slug;
        $query->where('site', '=', $this->site);
        return $query;
    }
}
