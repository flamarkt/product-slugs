<?php

namespace Flamarkt\ProductSlugs;

use Flamarkt\Core\Api\Serializer\ProductSerializer;
use Flamarkt\Core\Product\Product;

class ProductAttributes
{
    public function __invoke(ProductSerializer $serializer, Product $product): array
    {
        return [
            // For now we show this value to everyone, it doesn't really matter since it is public anyway
            'slugEdit' => $product->slug,
        ];
    }
}
