<?php
use App\Enums\Role;
return [
    'super_admin' => [
        'email' => 'clickweb@example.com',
        'password' => 'password',
    ],
    'allowed_relationships' => [ 
        'user' => ['companies', 'projects', 'companies.projects'],
        'company' => ['projects'],
        'project' => ['company'],
    ],
    'tests' => [
        'users' => [
            'create' => [
                'name' => 'Konstantin',
                'last_name' => 'Kichin',
                'email' => 'newuser@example.com',
                'password' => 'password',
                'password_confirmation' => 'password'
            ],
            'update' => [
                'name' => 'Konstantin',
                'last_name' => 'Updated',
                'email' => '@example.com',
                'password' => 'password',
                'password_confirmation' => 'password',
                'role' => Role::User
            ],
        ],
        'companies' => [
            'create' => [
                'address' => 'Some address',
                'logo' => 'logo.png',
                'website' => 'https://clickweb.test.com',
            ],
            'update' => [
                'address' => 'Some other address',
                'logo' => 'logo.png',
                'website' => 'https://clickweb.test.com',
            ],
        ]

    ],
    'currency' => 'EUR',
    'currency_symbol' => '€',

];
