<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin routes prefix.
    |--------------------------------------------------------------------------
     */
    'route' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Array of all sanjab controllers.
    |--------------------------------------------------------------------------
     */
    'controllers' => [
        App\Http\Controllers\Admin\DashboardController::class,
        App\Http\Controllers\Admin\Crud\UserController::class,
        App\Http\Controllers\Admin\Crud\CategoryController::class,
        App\Http\Controllers\Admin\Crud\ProductController::class,
        App\Http\Controllers\Admin\Crud\CommentController::class,
        App\Http\Controllers\Admin\Setting\GeneralSettingController::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | All locales availble for website.
    |--------------------------------------------------------------------------
    |
    | Array of locales. keys are locale ISO key and array values are title of locale to show to admins.
    |
     */
    'locales' => [
        'en' => 'English',
    ],

    /*
    |--------------------------------------------------------------------------
    | User login config.
    |--------------------------------------------------------------------------
     */
    'login' => [
        /**
         * Field inside \App\User model to use as username.
         */
        'username'  => 'mobile',

        /**
         * Username label that shows to admin in login page.
         */
        'title'     => 'شماره همراه',

        /**
         * Enable recaptcha for login.
         */
        'recaptcha' => true
    ],

    /*
    |--------------------------------------------------------------------------
    | Recaptcha information.
    |--------------------------------------------------------------------------
    |
    | Submit your app at https://www.google.com/recaptcha and add site-key and secret-key here.
    | It's recommneded to use .env file instead of modify this directly.
    | Sanjab using recaptcha v2.
    |
     */
    'recaptcha' => [
        /**
         * Recaptcha site key
         */
        'site_key'        => env('RECAPTCHA_SITE_KEY'),

        /**
         * Recaptcha secret key
         */
        'secret_key'      => env('RECAPTCHA_SECRET_KEY'),

        /**
         * Recaptcha will always passed on debug.
         */
        'ignore_on_debug' => true
    ],

    /*
    |--------------------------------------------------------------------------
    | Theme settings.
    |--------------------------------------------------------------------------
     */
    'theme' => [
        /*
        |--------------------------------------------------------------------------
        | Theme color.
        |--------------------------------------------------------------------------
        |
        | Possible values are: 'red','pink','purple','deep-purple','indigo','blue',
        | 'light-blue','cyan','teal','green','light-green','lime','yellow',
        | 'amber','orange','deep-orange','brown','grey','blue-grey'
        |
        */
        'color' => 'green',

        /*
        |--------------------------------------------------------------------------
        | Footer text content.
        |--------------------------------------------------------------------------
        */
        'footer_note' => '&copy; <script>document.write(new Date().getFullYear())</script>,
                        made with <i class="material-icons">favorite</i> by Creative Tim.
                        Powered by Sanjab',

        /*
        |--------------------------------------------------------------------------
        | Footer links.
        |--------------------------------------------------------------------------
        |
        | Array of links in footer.
        | Example: [
        |    ['title' => 'title of link', 'link' => 'link URL']
        | ]
        |
        */
        'footer_links' => [
            ['title' => 'LARAVEL', 'link' => 'https://laravel.com/'],
            ['title' => 'CREATIVE TIM', 'link' => 'https://www.creative-tim.com/'],
            ['title' => 'SANJAB', 'link' => 'https://sanjabteam.github.io/'],
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Elfinder filemanager settings.
    |--------------------------------------------------------------------------
    */
    'elfinder' => [
        /*
        |--------------------------------------------------------------------------
        | Is elfinder availble in sidebar menu.
        |--------------------------------------------------------------------------
        */
        'enabled' => true,

        /*
        |--------------------------------------------------------------------------
        | Disks available in el finder file manager.
        |--------------------------------------------------------------------------
        |
        | Array of disks with their alias.
        | Example: [
        |    'public' => 'Uploads',
        |    'local' => 'Private storage'
        | ]
        |
        */
        'disks' => [
            'public' => 'Uploads'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins configuration.
    |--------------------------------------------------------------------------
    */
    'plugins' => [
        /*
        |--------------------------------------------------------------------------
        | Plugin's service providers that should be booted before sanjab service provider.
        |--------------------------------------------------------------------------
        */
        'providers' => [],
    ],
];
