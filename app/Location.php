<?php

namespace App;

use Bkwld\Decoy\Models\Base;
use Bkwld\Decoy\Models\Traits\HasImages;

class Location extends Base
{
    use HasImages;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'address' => 'required',
    ];

    /**
     * List of all relationships
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function maps()
    {
        return $this->hasMany(BlockMap::class);
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
     * Compute the latitude and longitude on save
     *
     * @return void
     */
    public function onSaving()
    {
        $geo = file_get_contents('https://maps.google.com/maps/api/geocode/json?'
            .http_build_query([
                'address' => $this->address,
                'sensor' => 'false',
                'key' => config('services.google.maps.key'),
        ]));
        
        $output = json_decode($geo);
        if (!empty($output->results[0])) {
            $this->latitude = $output->results[0]->geometry->location->lat;
            $this->longitude = $output->results[0]->geometry->location->lng;
        }
    }

    /**
     *
     */
    public function getMapSrcAttribute()
    {
        $key = 'AIzaSyB5HDvF5YScRJquwKQcFBSub8nJEUltGBI';
        $url = 'https://maps.googleapis.com/maps/api/staticmap';
        return $url.'?center='.$this->latitude.','.$this->longitude.'&zoom=12&size=300x300&maptype=roadmap&markers=color:blue%7Clabel:%7C'.$this->latitude.','.$this->longitude.'&key='.$key;
    }

}
