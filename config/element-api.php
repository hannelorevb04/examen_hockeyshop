<?php


use craft\elements\Asset;
use craft\elements\Entry;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
        '/api/products' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'products'],
                'cache' => false,
                'serializer' => 'jsonFeed',

                'transformer' => function(Entry $entry) {
                    return [
                        'productImage' => str_replace("https","http",$entry->productImage->one()->getUrl()),
                        'title' => $entry->title,
                        'description' => $entry->description,
                        'price' => $entry->price,
                        'onSale' => $entry->onSale,
                        'discountPercentage' => $entry->discountPercentage,
                    ];
                },
            ];
        },
        'api/products/<entryId:\d+>.json' => function($entryId) {
            return [
                'elementType' => Entry::class,
                'criteria' => ['id' => $entryId],
                'one' => true,

                'cache' => false,
                'serializer' => 'jsonFeed',

                'transformer' => function(Entry $entry) {
                    return [
                        'productImage' => str_replace("https","http",$entry->productImage->one()->getUrl()),
                        'title' => $entry->title,
                        'description' => $entry->description,
                        'price' => $entry->price,
                        'onSale' => $entry->onSale,
                        'discountPercentage' => $entry->discountPercentage,
                    ];
                },
            ];
        },
    ]
];