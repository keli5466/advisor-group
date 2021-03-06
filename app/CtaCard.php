<?php

namespace App;

use Bkwld\Decoy\Models\Base;
use Bkwld\Decoy\Models\Traits\HasImages;

class CtaCard extends Base
{
    use HasImages;

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['headline', 'subhead', 'copy', 'cta', 'url'];

    /**
     * List of all relationships
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockImageAndCtas()
    {
        return $this->belongsTo(BlockImageAndCta::class);
    }
    public function blockTwoColumnCtas()
    {
        return $this->belongsTo(BlockTwoColumnCtas::class);
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
     * Make the admin title
     *
     * @return string
     */
    public function getAdminTitleAttribute()
    {
        // Use label if it exists
        if ($this->headline) return $this->headline;

        // Check for attributes on the type
        if ($type = $this->typeModel()) {
            foreach(['title', 'headline', 'label'] as $attribute) {
                if ($type->$attribute) return $type->$attribute;
            }
        }

        // Default to the type
        return $this->type_title;
    }
}
