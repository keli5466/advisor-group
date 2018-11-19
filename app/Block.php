<?php

namespace App;

// Deps
use Bkwld\Decoy\Models\Base;
use Bkwld\Decoy\Models\Traits\HasImages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Block extends Base
{
    use HasImages;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'slug' => 'nullable|alpha_dash',
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['slug', 'type', 'id'];

    /**
     * The block types
     *
     * @var array
     */
    public static $types = [
        'anchorLinks' => ['Anchor Links', 'Links that jump down the page.'],
        'centeredCallout' => ['Centered Callout', 'Centered title and copy.'],
        'contactForm' => ['Contact Form', 'The contact form block that appears at the bottom of most <b>Towers</b>.'],
        'copyAndIconBulletPoint' => ['Copy & Icon Bullet Points', 'Copy and icon bullet point list.'],
        'copyAndImage' => ['Copy & Image', 'Copy and Image block that can also contain a video embed.'],
        'employeeListing' => ['Employees Listing', 'A list of employees.'],
        'firmsListing' => ['Firms Listing', 'The listing of firms with the anchor links bar on top.'],
        'fullBleedCta' => ['Full Bleed CTA', 'CTA with a full bleed image background.'],
        'iconToutsAndImage' => ['Icon Touts & Image', 'Three wide list of icon touts with an image on the right or left.'],
        'imageAndCta' => ['Image and CTA', 'A single CTA with an image beside it.'],
        'map' => ['Map', 'A google map with <b>Locations</b>.'],
        'marquee' => ['Marquee', 'A hero space for the top of <b>Towers</b>.'],
        'multiBlurb' => ['Multi Blurb', 'A listing of icon touts and blurbs.'],
        'newsListing' => ['News Listing', 'A paginated list of news articles.'],
        'resourcesListing' => ['Resources Listing', 'A paginated list of resource articles.'],
        'twoColumnCtas' => ['Two Column CTAs', 'Side by side CTA\'s.'],
        'twoColumnIconTouts' => ['Two Column Icon Touts', 'Two columned icon touts with eyebrow and headline.'],
        'valueProps' => ['Value Props', 'A list of icon touts with a CTA at the end.'],
        'wysiwyg' => ['Wysiwyg', 'A wysiwyg block.'],
    ];

    /**
     * The types accesible to a polymoprhic blockable parent
     *
     * @var array
     */
    public static $blockable_types = [
        Tower::class => [
            'anchorLinks',
            'centeredCallout',
            'contactForm',
            'copyAndIconBulletPoint',
            'copyAndImage',
            'employeeListing',
            'firmsListing',
            'fullBleedCta',
            'iconToutsAndImage',
            'map',
            'marquee',
            'multiBlurb',
            'newsListing',
            'resourcesListing',
            'valueProps',
            'wysiwyg',
        ],
        Article::class => [
            'imageAndCta',
            'twoColumnCtas',
            'twoColumnIconTouts',
        ],
    ];

    /**
     * Relationships to copy during duplication
     *
     * @var array
     */
    protected $cloneable_relations = [
        'blockAnchorLinks',
        'blockCenteredCallout',
        'blockContactForm',
        'blockCopyAndImage',
        'blockCopyAndIconBulletPoint',
        'blockCopyAndImage',
        'blockEmployeeListing',
        'blockFullBleedCta',
        'blockIconToutsAndImage',
        'blockImageAndCta',
        'blockMap',
        'blockMarquee',
        'blockMultiBlurb',
        'blockTwoColumnCtas',
        'blockTwoColumnIconTouts',
        'blockValueProps',
        'blockWysiwyg',
    ];

    /**
     * Parent relation
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockable()
    {
        return $this->morphTo();
    }

    /**
     * Anchor Links block
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockAnchorLinks()
    {
        return $this->hasOne(BlockAnchorLinks::class);
    }

    /**
     * Marquee block
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockMarquee()
    {
        return $this->hasOne(BlockMarquee::class);
    }

    /**
     * Contact Form block
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockContactForm()
    {
        return $this->hasOne(BlockContactForm::class);
    }

    /**
     * Centered Callout block
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockCenteredCallout()
    {
        return $this->hasOne(BlockCenteredCallout::class);
    }

    /**
     * Copy & Image block
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockCopyAndImage()
    {
        return $this->hasOne(BlockCopyAndImage::class);
    }

    /**
     * Copy & Image block
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockCopyAndIconBulletPoint()
    {
        return $this->hasOne(BlockCopyAndIconBulletPoint::class);
    }

    /**
     * Icon touts and image block
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockIconToutsAndImage()
    {
        return $this->hasOne(BlockIconToutsAndImage::class);
    }

    /**
     * Firms listing block
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockFirmsListing()
    {
        return $this->hasOne(BlockFirmsListing::class);
    }

    /**
     * Full bleed cta block
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockFullBleedCta()
    {
        return $this->hasOne(BlockFullBleedCta::class);
    }

    /**
     * Employees listing block
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockEmployeeListing()
    {
        return $this->hasOne(BlockEmployeeListing::class);
    }

    /**
     * Map block
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockMap() {
        return $this->hasOne(BlockMap::class);
    }

    /**
     * Multi Blurb block
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockMultiBlurb() {
        return $this->hasOne(BlockMultiBlurb::class);
    }

    /**
     * Value Props block
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockValueProps()
    {
        return $this->hasOne(BlockValueProps::class);
    }

    /**
     * Wysiwyg block
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockWysiwyg()
    {
        return $this->hasOne(BlockWysiwyg::class);
    }

    /**
     * Image and CTA block
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockImageAndCta()
    {
        return $this->hasOne(BlockImageAndCta::class);
    }

    /**
     * Two Column CTAs block
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockTwoColumnCtas()
    {
        return $this->hasOne(BlockTwoColumnCtas::class);
    }

    /**
     * Two Column Icon touts block
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockTwoColumnIconTouts()
    {
        return $this->hasOne(BlockTwoColumnIconTouts::class);
    }

    /**
     * Marquee Block Images
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockMarqueeImages() {
        return $this->hasMany(BlockMarqueeImage::class);
    }

    /**
     * Links
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function links() {
        return $this->hasMany(Link::class);
    }

    /**
     * Icon Touts
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function iconTouts() {
        return $this->hasMany(IconTout::class);
    }

    /**
     * Blurbs
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blurbs() {
        return $this->hasMany(Blurb::class);
    }

    /**
     * Locations
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function locations() {
        return $this->hasMany(Location::class);
    }

    /**
     * CTA Cards
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function ctaCards() {
        return $this->hasMany(CtaCard::class);
    }

    /**
     * Get the relation for the current type
     *
     * @param  string $type Override the default of using the model's type value
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function type($type = null)
    {
        if (!$type) $type = $this->type;
        if (method_exists($this, $this->typeRelationName($type))) {
            return call_user_func([$this, $this->typeRelationName($type)]);
        }
    }

    /**
     * Get the block type model
     *
     * @return  Model
     */
    public function typeModel()
    {
        if ($relation = $this->type()) {
            return $relation->first();
        }
    }

    /**
     * Make the relationship name for the type
     *
     * @param  string $type
     * @return string
     */
    public function typeRelationName($type = null)
    {
        if (!$type) $type = $this->type;
        return 'block'.studly_case($type);
    }

    /**
     * Put new instances at the end
     *
     * @return void
     */
    public function onCreating()
    {
        if (isset($this->position)) return;
        $this->position = $this->blockable->blocks()->max('position') + 1;
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
        return $query->where('blockable_type', $this->blockable_type)
            ->where('blockable_id', $this->blockable_id);
    }

    /**
     * Return the URI to instances of this model
     *
     * @return string A URI that the browser can resolve
     */
    public function getUriAttribute()
    {
        if ($this->slug) {
            return $this->blockable->uri.'#'.$this->slug;
        }
    }

    /**
     * Format the types for the admin
     *
     * @return array
     */
    public static function typesForAdmin()
    {
        $parent_class = static::blockableTypeFromRoute();
        return collect(static::$blockable_types[$parent_class])
            ->mapWithKeys(function($key) {
                list($name, $label) = static::$types[$key];
                return [ $key => "<span
                    class='label label-default'>{$name}</span> {$label}"
                ];
            })
            ->all();
    }

    /**
     * Get the blockable class from the admin route segment
     *
     * @return string
     */
    public static function blockableTypeFromRoute()
    {
        return 'App\\'.str_singular(studly_case(request()->segment(2)));
    }

    /**
     * Get the type title
     *
     * @return string
     */
    public function getTypeTitleAttribute()
    {
        return static::$types[$this->type][0] ?? '';
    }

    /**
     * Subclass to memove the deep link column form listings, cause layout gets
     * weird since it's optional.
     *
     * @param array $data The data passed to a listing view
     * @return array
     */
    public function makeAdminActions($data) {
        $actions = [];
        if ($html = $this->makeVisibilityAction($data)) $actions['visibility'] = $html;
        if ($html = $this->makeEditAction($data))       $actions['edit'] = $html;
        if ($html = $this->makeDeleteAction($data))     $actions['delete'] = $html;
        return $actions;
    }

    /**
     * Make the admin title
     *
     * @return string
     */
    public function getAdminTitleAttribute()
    {
        // Use label if it exists
        if ($this->label) return $this->label;

        // Check for attributes on the type
        if ($type = $this->typeModel()) {
            foreach(['title', 'headline', 'label'] as $attribute) {
                if ($type->$attribute) return $type->$attribute;
            }
        }

        // Default to the type
        return $this->type_title;
    }

    /**
     * Make the admin type
     *
     * @return string
     */
    public function getAdminTypeAttribute()
    {
        if ($this->type)
            return '<span class="label label-default">'
                .$this->getTypeTitleAttribute().'</span>';

        return '';
    }

    /**
     * Map block data for the API
     *
     * @return array
     */
    public function forApi() {
        if ($type = $this->typeModel()) {
            return array_merge($type->forApi($this), $this->toArray());
        } else if (in_array($this->type, ['newsListing', 'resourcesListing'])) {
            $type = $this->type == 'newsListing' ? 'news' : 'resources';
            return array_merge($this->toArray(), [
                'articles' => Article::paginateForApi($type),
            ]);
        } else {
            return $this->toArray();
        }
    }
}
