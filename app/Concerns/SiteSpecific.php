<?php

namespace App\Concerns;

// Deps
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Scope the model to the current Site
 */
trait SiteSpecific {

    /**
     * Add the global SiteSpecific scope
     *
     * @return void
     */
    public static function bootSiteSpecific()
    {
        // Set site value
        static::creating(function ($model) {
            $model->site = app('site')->slug;
        });

        // Add the scope
        static::addGlobalScope('site specific', function(Builder $query) {
            $query->where('site', '=', app('site')->slug);
        });
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $attribute
     * @param array $config
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithUniqueSlugConstraints(
        Builder $query, Model $model, $attribute, $config, $slug)
    {
        return $query->where('site', '=', app('site')->slug);
    }

}
