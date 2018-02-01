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
        'league' => 'League',
        'team' => 'Team',
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
    'league' => [
        'index' => [
            'title' => 'Leagues',
            'add' => [
                'title' => 'Add new league',
                'name' => 'Name',
                'name_placeholder' => 'League',
                'year' => 'Year',
                'year_placeholder' => '1996',
                'description' => 'description',
                'description_placeholder' => '',
                'submit_button' => 'Add',
                'message' => [
                    'add_success' => 'Add league successfully',
                    'add_error' => 'Add league fail',
                ],
            ],
            'edit' => [
                'title' => 'Edit the league',
                'name' => 'Name',
                'name_placeholder' => 'League',
                'year' => 'Year',
                'year_placeholder' => '1996',
                'description' => 'description',
                'description_placeholder' => '',
                'submit_button' => 'Edit',
                'message' => [
                    'edit_success' => 'Edit the league successfully',
                    'not_found' => 'The league not found',
                ],
            ],
            'delete' => [
                'message' => [
                    'delete_success' => 'Remove league successfully',
                    'not_found' => 'The league not found',
                    'delete_error' => 'Remove league fail',
                    'delete_error1451' => 'Information is being used, can not be deleted',
                ],
            ],
            'table' => [
                'title' => 'Leagues',
                'search_placeholder' => 'Please enter the keyword...',
                'id' => '#',
                'name' => 'Name',
                'description' => 'Description',
                'year' => 'Year',
                'no_results' => 'No results',
                'edit_button_title' => 'Edit League',
                'remove_button_title' => 'Remove',
                'message' => [
                    'delete_confirm' => 'Do you want to remove this league?',
                ],
            ],
        ],
    ],
    'team' => [
        'index' => [
            'title' => 'Teams',
            'add' => [
                'title' => 'Add new team',
                'name' => 'Name',
                'name_placeholder' => 'Team',
                'logo' => 'Logo',
                'country' => 'Country',
                'description' => 'description',
                'description_placeholder' => '',
                'submit_button' => 'Add',
                'message' => [
                    'add_success' => 'Add team successfully',
                    'add_error' => 'Add team fail',
                ],
            ],
            'edit' => [
                'title' => 'Edit the team',
                'name' => 'Name',
                'name_placeholder' => 'Team',
                'logo' => 'Logo',
                'country' => 'Country',
                'description' => 'description',
                'description_placeholder' => '',
                'submit_button' => 'Edit',
                'message' => [
                    'edit_success' => 'Edit the team successfully',
                    'not_found' => 'The team not found',
                ],
            ],
            'delete' => [
                'message' => [
                    'delete_success' => 'Remove team successfully',
                    'not_found' => 'The team not found',
                    'delete_error' => 'Remove team fail',
                    'delete_error1451' => 'Information is being used, can not be deleted',
                ],
            ],
            'table' => [
                'title' => 'Teams',
                'search_placeholder' => 'Please enter the keyword...',
                'id' => '#',
                'logo' => 'Logo',
                'name' => 'Name',
                'country' => 'Country',
                'description' => 'Description',
                'no_results' => 'No results',
                'edit_button_title' => 'Edit team',
                'remove_button_title' => 'Remove',
                'message' => [
                    'delete_confirm' => 'Do you want to remove this team?',
                ],
            ],
        ],
    ],
];
