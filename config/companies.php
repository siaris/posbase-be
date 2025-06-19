<?php

return [
    'companies' => [
        'client1' => [
            'name' => 'Client Satu',
            'slug' => 'client1',
            'is_active' => true,
            'config' => [
                'theme' => 'blue',
                'auth_methods' => ['form', 'google']
            ]
        ],
        'client2' => [
            'name' => 'Client Dua',
            'slug' => 'client2', 
            'is_active' => false,
            'config' => [
                'theme' => 'red',
                'auth_methods' => ['form']
            ]
        ],
        'test' => [
            'name' => 'APOTEK TEST',
            'slug' => 'test', 
            'is_active' => true,
            'config' => [
                'theme' => 'red',
                'auth_methods' => ['form']
            ]
        ]
    ],
    
    // Default config untuk company yang tidak terdaftar
    'default' => [
        'name' => 'Default Client',
        'slug' => 'default',
        'is_active' => true,
        'config' => [
            'theme' => 'gray',
            'auth_methods' => ['form']
        ]
    ]
];