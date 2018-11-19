<?php

use App\Facades\Eloqua;
use Illuminate\Http\Request;

// Get a nav and all it's links
Route::get('nav/{nav}', function(App\Nav $nav) {
    $nav->enforceVisibility();
    return $nav
        ->load(['navRootLinks' => function($query) { $query->listing(); }])
        ->serializeTransform(function($nav) {
            $nav->navRootLinks->serializeTransform(function($rootLink) {
                return $rootLink->forApi();
            });
        });
})->where('nav', '.+');

// Get a tower and all it's blocks
Route::get('tower/{tower}', function(App\Tower $tower) {
    $tower->enforceVisibility();
    return $tower
        ->withImage('image', 1024)
        ->load(['blocks' => function($query) { $query->listing(); }])
        ->serializeTransform(function($tower) {
            $tower->blocks->serializeTransform(function($block) {
                return $block->forApi();
            });
            return $tower;
        });
})->where('tower', '.+');

// Get lists of articles
Route::get('{type}', function($type) {
    return App\Article::paginateForApi($type);
})->where('type', 'news|resources');

// Get an article and all it's blocks
Route::get('article/{article}', function(App\Article $article) {
    $article->enforceVisibility();
    return $article
        ->withImage('marquee', 1024)
        ->withImage('listing', 1024)
        ->load(['blocks' => function($query) { $query->listing(); }])
        ->serializeTransform(function($article) {
            $article->blocks->serializeTransform(function($block) {
                return $block->forApi();
            });
            return $article;
        });
})->where('article', '.+');

// Get a group elements
Route::get('layout/{element}', function($element) {
    $element = Decoy::els('site.'.$element);
    return $element;
});

// Get a single element
Route::get('layout/{element_group}/{element}', function($element_group, $element) {
    $element = Decoy::el('site.'.$element_group.'.'.$element)->value;
    return $element;
});

// Return all paths for use with Nuxt generate
Route::get('routes', function() {
    return App\Tower::listing()->get()
        ->map(function($tower) {
            return '/'.$tower->route;
        })->concat(
            App\Article::listing()->get()
                ->map(function($article) {
                    return "/{$article->type}/{$article->slug}";
                })
        );
});

// Eloqua forms
Route::get('form/{element}', function($element) {
    return Eloqua::getFormWithOptions(Decoy::el('site.forms.'.$element));
});
Route::post('form/{element}', function(Request $request, $element) {
    $form_id = Decoy::el('site.forms.'.$element)->value();
    Eloqua::submit($form_id, $request->all());
});
