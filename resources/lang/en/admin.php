<?php

return [
    'title' => 'Control Panel',
    'test' => 'Test',
    'navbar' => [
        'toggle_navigation' => 'Toggle navigation',
        'dashboard' => 'Dashboard',
        'search' => 'Search',
        'login' => 'Login',
        'logout' => 'Logout',
    ],
    'sidebar_menu' => [
        'home' => 'Home',
        'dashboard' => 'Dashboard',
        'country' => 'Country',
    ],
    'footer_menu' => [
        'home' => 'Home',
    ],
    '404' => '404 Not Found',
    '403' => '403 Forbidden',
    'oops' => 'Oops',
    'auth' => [
        'register' => 'Register',
        'login' => 'Login',
        'reset_password' => 'Reset Password',
        'email' => 'Email address',
        'send_reset_link' => 'Send Reset Link',
        'password' => 'Password',
        'password_confirmation' => 'Password Confirmation',
        'forgot_password' => 'Forgot Password',
        'remember' => 'Remember',
        'name' => 'Name',
    ],
    'country' => [
        'index' => [
            'title' => 'Countries',
            'add' => [
                'title' => 'Add new country',
                'name' => 'Country',
                'name_placeholder' => 'Country',
                'submit_button' => 'Add',
                'message' => [
                    'add_success' => 'Add country successfully',
                    'add_error' => 'Add country fail',
                ],
            ],
            'edit' => [
                'title' => 'Edit the country',
                'name' => 'Country',
                'name_placeholder' => 'Country',
                'submit_button' => 'Edit',
                'message' => [
                    'edit_success' => 'Edit the country successfully',
                    'not_found' => 'The country not found',
                ],
            ],
            'delete' => [
                'message' => [
                    'delete_success' => 'Remove country successfully',
                    'not_found' => 'The country not found',
                    'delete_error' => 'Remove country fail',
                    'delete_error1451' => 'Information is being used, can not be deleted',
                ],
            ],
            'table' => [
                'title' => 'Countries',
                'search_placeholder' => 'Please enter the keyword...',
                'id' => '#',
                'name' => 'Name',
                'no_results' => 'No results',
                'edit_button_title' => 'Edit Country',
                'remove_button_title' => 'Remove',
                'message' => [
                    'delete_confirm' => 'Do you want to remove this country?',
                ],
            ],
        ],
    ],
];
