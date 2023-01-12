<?php

namespace Flamarkt\ProductSlugs\Listeners;

use Flamarkt\Core\Product\Event\Saving;
use Illuminate\Support\Arr;

class SaveProduct
{
    public function handle(Saving $event)
    {
        $attributes = (array)Arr::get($event->data, 'attributes');

        if (Arr::exists($attributes, 'slug')) {
            // Replace empty strings with null because that's how the validator will have read nullable
            $event->product->slug = Arr::get($attributes, 'slug') ?: null;
        }
    }
}
