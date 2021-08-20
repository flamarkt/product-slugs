<?php

namespace Flamarkt\ProductSlugs\Listeners;

use Flamarkt\Core\Product\Event\Saving;
use Illuminate\Support\Arr;

class SaveProduct
{
    public function handle(Saving $event)
    {
        $attributes = (array)Arr::get($event->data, 'data.attributes');

        if (Arr::exists($attributes, 'slug')) {
            $event->product->slug = Arr::get($attributes, 'slug');
        }
    }
}
