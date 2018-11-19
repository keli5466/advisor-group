<?php

namespace App\Http\Controllers\Admin;

// Deps
use App\Services\CurrentSite;
use Bkwld\Decoy\Controllers\Base;

class Site extends Base
{
    /**
     * Switch sites
     *
     * @param  string $slug
     * @return Redirect
     */
    public function redirect(string $slug)
    {
        if (in_array($slug, array_keys(app('site')->sites))) {
            session([ CurrentSite::SESSION_KEY => $slug ]);
            return redirect('admin');
        }
        abort(404);
    }
}
