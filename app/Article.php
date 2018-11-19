<?php

namespace App;

// Deps
use App\Concerns\HasBlocks;
use App\Concerns\SiteSpecific;
use Bkwld\Decoy\Models\Base;
use Bkwld\Decoy\Models\Traits\HasImages;

class Article extends Base
{
    use HasImages, SiteSpecific, HasBlocks;

    /**
     * How many to fetch per page
     *
     * @var integer
     */
    const PER_PAGE = 12;

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['title', 'type', 'date', 'abstract', 'slug', 'eyebrow', 'tag', 'body', 'blocks', 'cta_text', 'gated'];

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
     * Article types
     */
    public static $types = [
        'news' => 'news',
        'resources' => 'resources',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
       'title' => 'required',
       'slug' => 'alpha_dash|unique:articles',
       'date' => 'required',
    ];

    /**
     * Orders instances of this model in the admin as well as default ordering
     * to be used by public site implementation.
     *
     * @param  Illuminate\Database\Query\Builder $query
     * @return void
     */
    public function scopeOrdered($query)
    {
        // $query->orderBy('date', 'desc');
    }

    /**
     * Return the URI to instances of this model
     *
     * @return string A URI that the browser can resolve
     */
    public function getUriAttribute()
    {
        return app('site')->url($this->type.'/'.$this->slug);
    }

    /**
     * Make all src's in the body include the API server's hostname
     * https://regex101.com/r/LJOyxU/2
     *
     * @return string A URI that the browser can resolve
     */
    public function getBodyAttribute($body)
    {
        return app('site')->addApiUrlToLinks($body);
    }

    /**
     * Return the first page of results
     *
     * @param  string $type
     * @return Collection
     */
    public static function paginateForApi($type)
    {
        $result = static::listing()
            ->where('type', $type)
            ->orderBy('date', 'DESC')
            ->paginate(static::PER_PAGE);
        $result->getCollection()->withImage('listing', 500);
        return $result;
    }
}
