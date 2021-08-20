<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->table('flamarkt_products', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable();
        });
    },
    'down' => function (Builder $schema) {
        $schema->table('flamarkt_products', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    },
];
