<?php

return [
    'system_roles' => [
        env('ADMIN_ROLE', 'admin'),
        env('DOCS_ROLE', 'docs'),
    ],
    'admin_role' => env('ADMIN_ROLE', 'admin'),
    'docs_role' => env('DOCS_ROLE', 'docs'),
];
