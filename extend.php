<?php

namespace Flamarkt\ProductSlugs;

use Flamarkt\Core\Api\Serializer\BasicProductSerializer;
use Flamarkt\Core\Product\Event\Saving;
use Flamarkt\Core\Product\Product;
use Flamarkt\Core\Product\ProductValidator;
use Flarum\Extend;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

return [
    (new Extend\Frontend('backoffice'))
        ->js(__DIR__ . '/js/dist/backoffice.js'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\Event())
        ->listen(Saving::class, Listeners\SaveProduct::class),

    (new Extend\ApiSerializer(BasicProductSerializer::class))
        ->attributes(ProductAttributes::class),

    (new Extend\ModelUrl(Product::class))
        ->addSlugDriver('slug', SlugDriver::class),

    (new Extend\Validator(ProductValidator::class))
        ->configure(function (ProductValidator $flarumValidator, Validator $validator) {
            $rule = Rule::unique('flamarkt_products', 'slug');

            $product = $flarumValidator->getProduct();

            if ($product) {
                $rule->ignore($product);
            }

            $validator->addRules([
                'slug' => [
                    'nullable',
                    'regex:/^[a-z0-9_-]+$/i',
                    'max:255',
                    $rule,
                ],
            ]);
        }),
];
