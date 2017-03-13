<?php
return [
    'info' => 'product/management/index',
    'products' => 'product/management/products',
    'showcase' => 'product/default/index',
    'cart' => 'product/default/cart',
    'add' => 'product/default/add',
    'delete' => 'product/default/delete',
    'create' => 'product/swagger/create',
    [
    'pattern' => 'get/<id:\d+>',
    'route' => 'product/swagger/get',
    'defaults' => ['id' => 1],
    ],
    [
        'pattern' => 'update/<id:\d+>',
        'route' => 'product/swagger/update',
        'defaults' => ['id' => 1],
    ],
];