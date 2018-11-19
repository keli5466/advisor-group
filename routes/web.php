<?php

// Set the active site for the admin
Route::get('admin/site/{slug}', 'Admin\Site@redirect')
    ->middleware('decoy.protected');

// Finish Decoy routes manually
app('decoy.router')->registerAll();
