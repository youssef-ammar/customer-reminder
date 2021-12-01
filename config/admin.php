
<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Default admin user
    |--------------------------------------------------------------------------
    |
    | Default user will be created at project installation/deployment
    |
    */

    'admin_role_id' => env('ADMIN_ROLE_ID', '0'),
    'admin_email' => env('ADMIN_EMAIL', 'admin@admin.com'),
    'admin_password' => env('ADMIN_PASSWORD', 'admin')

    ];
