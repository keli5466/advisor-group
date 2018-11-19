<?php

namespace App;

use App\Concerns\IsPositionedBlockChild;
use Bkwld\Decoy\Models\Base;
use Bkwld\Decoy\Models\Traits\HasImages;

class IconTout extends Base
{
    use HasImages, IsPositionedBlockChild;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
       'images.icon' => 'image|required',
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['headline', 'copy', 'cta', 'url'];

    /**
     * List of all relationships
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function copyAndIconBulletPoints()
    {
        return $this->belongsTo(BlockCopyAndIconBulletPoint::class);
    }
    public function iconToutsAndImages()
    {
        return $this->belongsTo(BlockIconToutsAndImage::class);
    }
    public function multiBlurbs()
    {
        return $this->belongsTo(BlockMultiBlurb::class);
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
