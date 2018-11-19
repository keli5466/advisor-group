<?php

namespace App\Services;

// Deps
use Cache;
use Decoy;

/**
 * Help identify the current site
 */
class CurrentSite
{
    /**
     * The slug of the current site handling the request
     *
     * @var string
     */
    public $slug;

    /**
     * Get the KEY
     *
     * @var string
     */
    const SESSION_KEY = 'site slug';

    /**
     * Choose the current site
     */
    public function __construct()
    {
        $this->slug = $this->guessSlug();
        $this->setCachePrefix();
    }

    /**
     * Guess the slug for the site of the current request
     *
     * @return string
     */
    public function guessSlug()
    {
        // Look in session, like from the admin's site switcher
        if ($slug = session(CurrentSite::SESSION_KEY)) {
            return $slug;
        }

        // Use HTTP header
        if ($slug = request()->header('X-Site-Slug')) {
            return $slug;
        }

        // Use env, if explicitly set
        if ($slug = config('site.slug')) {
            return $slug;
        }

        // Guess the current site from the subdomain
        $host = request()->getHost();
        if (preg_match('#^([\w\-]+)\.#', $host, $matches)) {
            $subdomain = $matches[1];
            if (in_array($subdomain, array_keys($this->sites))) {
                return $subdomain;
            }
        }

        // Default to "ag"
        return 'ag';
    }

    /**
     * List of all site slug possibilities
     *
     * @var array
     */
    public $sites = [
        'ag' => 'Advisor Group',
        'fsc' => 'FSC Securities Corporation',
        'raa' => 'Royal Alliance Associates',
        'spf' => 'SagePoint Financial',
        'wfs' => 'Woodbury Financial Services',
    ];

    /**
     * Get the current site's name
     *
     * @return string
     */
    public function name()
    {
        return $this->sites[$this->slug];
    }

    /**
     * Generate a route to curent public site, like where Laravel's `url()`
     * helper would normally be used.
     *
     * @param  string
     * @return string
     */
    public function url($path)
    {
        $root = Decoy::el('site.config.url');
        if (!ends_with($root, '/')) $root .= '/';
        $path = ltrim($path, '/');
        return $root.$path;
    }
    
    /**
     * Make all src's in a string include the API server's hostname
     * https://regex101.com/r/LJOyxU/2
     *
     * @param  string $str
     * @return string
     */
    public function addApiUrlToLinks($str)
    {
        $pattern = '#(src|href)\s*=\s*["\'](?!https?:\/\/)(\/uploads\/[^\'"]+)["\']#';
        return preg_replace($pattern, '$1="'.config('app.url').'$2"', $str);
    }
    
    /**
     * Make site specific caches
     * https://stackoverflow.com/a/51056969/59160
     * 
     * Note, this only works on NON file caches
     *
     * @return string
     */
    protected function setCachePrefix()
    {        
        config(['cache.prefix' => env('CACHE_PREFIX').$this->slug ]);
        if (method_exists(Cache::store()->getStore(), 'setPrefix')) {
            Cache::setPrefix(config('cache.prefix'));
        }
    }
}
