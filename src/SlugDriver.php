<?php

namespace Flamarkt\ProductSlugs;

use Flamarkt\Core\Product\Product;
use Flarum\Database\AbstractModel;
use Flarum\Http\SlugDriverInterface;
use Flarum\User\User;

class SlugDriver implements SlugDriverInterface
{
    public function toSlug(AbstractModel $instance): string
    {
        return $instance->slug ?? $instance->uid;
    }

    public function fromSlug(string $slug, User $actor): AbstractModel
    {
        return Product::whereVisibleTo($actor)
            ->where('slug', $slug)
            ->orWhere('uid', $slug)
            ->firstOrFail();
    }
}
