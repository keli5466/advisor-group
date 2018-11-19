<?php

namespace App\Listeners;

// Deps
use Decoy;
use GuzzleHttp\Client;

class RedeployNetlifyOnSave
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'eloquent.saved:*',
            'App\Listeners\RedeployNetlifyOnSave@onSave'
        );
        $events->listen(
            'eloquent.deleted:*',
            'App\Listeners\RedeployNetlifyOnSave@onSave'
        );
    }

    /**
     * On a save of data, redeploy Netlify
     *
     * @return void
     */
    public function onSave()
    {
        if (app()->environment('local')) return;
        if (!$hook = (string) Decoy::el('site.config.deploy_hook')) return;
        $client = new Client;
        $client->post($hook);
    }

}
