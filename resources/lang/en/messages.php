<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Status сообщения о действиях
    |--------------------------------------------------------------------------
    |
    | Блок с уведомлениями на сайте о действиях на странице.
    |
    */

    'saved'             => 'Saved',
    'changed'           => 'Changed',
    'updated'           => 'Updated',
    'restored'          => 'Restored',
    'deleted'           => 'Deleted',

    'status'    => [
        'changed'       => 'Status change',
    ],

    'category'  => [
        'restored'      => 'Category :name restored',
        'deletedHard'   => 'Category deleted',
        'deleted'       => 'Category :name marked to delete',
    ],

    'news'      => [
        'deletedHard'   => 'News deleted',
        'deleted'       => 'News ":name" marked to delete',
    ],

    'passwordChanged'   => 'Password changed',

    'userDeleted'       => 'Users deleted in database',

    'pages' => [
        'main' => [
            'lastNews'          => 'Last news in site',
            'notNews'           => 'Not news',
        ],
        'news' => [
            'author'            => 'Author',
            'category'          => 'Category',
            'categories'        => 'Categories',
            'notCategory'       => 'Not Categories',
            'source'            => 'Source',
            'title'             => 'Article',
            'text'              => 'News text',
            'newsInCategory'    => 'News in category :name',
            'notNewsInCategory' => 'Not news in this category',
        ],
        'admin' => [
            'publish'           => 'publish',
            'cancelPublish'     => 'cancel publish',
            'edit'              => 'edit',
            'restore'           => 'restore',
            'softDelete'        => 'delete',
            'hardDelete'        => 'delete in db',
            'save'              => 'save',
            'changePassword'    => 'change password',
            'newPassword'       => 'new password',
            'editUser'          => 'edit user data',
            'role'              => 'user role',
            'notUser'           => 'users not found',
            'deleted'           => 'deleted :data',
            'categoryIsDeleted' => 'category is deleted',
            'notCategory'       => 'not categories!',
            'addCategory'       => 'add new category',
            'failAccessUser'    => 'insufficient rights to perform this operation',
            'lenta'             => 'download news from Lenta.ru',
            'yandex'            => 'download news from Yandex.ru',
        ],
        'personal' => [
            'hello'             => 'Hello,',
            'yourEmail'         => 'your e-mail address',
            'yourNews'           => 'your published news',
            'social'            => 'Bind :name account',
        ],
        'other' => [
            'copy'              => 'Pilyugin Evgeny',
            'rememberMe'        => 'remember me',
            'singUp'            => 'registration',
            'comeIn'            => 'log In',
            'login'             => 'Login',
            'email'             => 'E-mail',
            'password'          => 'Password',
            'registration'      => 'registration',
            'social'            => ':name login',
        ],
    ],
];
