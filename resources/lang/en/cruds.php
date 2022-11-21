<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'approved'                 => 'Approved',
            'approved_helper'          => ' ',
            'team'                     => 'Team',
            'team_helper'              => ' ',
        ],
    ],
    'ussd' => [
        'title'          => 'Ussd',
        'title_singular' => 'Ussd',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'ussd_code'         => 'Ussd Code',
            'ussd_code_helper'  => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'user'              => 'User',
            'user_helper'       => 'Assign to user',
        ],
    ],
    'ussdMenu' => [
        'title'          => 'Ussd Menu',
        'title_singular' => 'Ussd Menu',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'ussd'                    => 'Ussd',
            'ussd_helper'             => 'Assign to ussd service code',
            'main_menu'               => 'Main Menu',
            'main_menu_helper'        => 'This PHP file will be applied in get_menu function. It is required for USSD end user menu to function',
            'initiate_request'        => 'Initiate Request File',
            'initiate_request_helper' => 'This PHP file depends on Main Menu PHP file. NOTE: The file affects how the landing will behave. It initiates the main_menu code',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
        ],
    ],
    'payment' => [
        'title'          => 'Payment',
        'title_singular' => 'Payment',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'msisdn'            => 'Msisdn',
            'msisdn_helper'     => ' ',
            'account'           => 'Account',
            'account_helper'    => ' ',
            'amount'            => 'Amount',
            'amount_helper'     => ' ',
            'reference'         => 'Reference',
            'reference_helper'  => ' ',
            'origin'            => 'Origin',
            'origin_helper'     => ' ',
            'mode'              => 'Mode',
            'mode_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'session'           => 'Session',
            'session_helper'    => ' ',
            'ussd_code'         => 'Ussd Code',
            'ussd_code_helper'  => ' ',
        ],
    ],
    'session' => [
        'title'          => 'Sessions',
        'title_singular' => 'Session',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'session'             => 'Session',
            'session_helper'      => ' ',
            'service_code'        => 'Service Code',
            'service_code_helper' => ' ',
            'msisdn'              => 'Msisdn',
            'msisdn_helper'       => ' ',
            'ussd_string'         => 'Ussd String',
            'ussd_string_helper'  => ' ',
            'title'               => 'Title',
            'title_helper'        => ' ',
            'menu'                => 'Menu',
            'menu_helper'         => ' ',
            'selection'           => 'Selection',
            'selection_helper'    => ' ',
            'min_val'             => 'Min Val',
            'min_val_helper'      => ' ',
            'max_val'             => 'Max Val',
            'max_val_helper'      => ' ',
            'session_date'        => 'Session Date',
            'session_date_helper' => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'level'               => 'Level',
            'level_helper'        => ' ',
        ],
    ],
    'userSession' => [
        'title'          => 'User Sessions',
        'title_singular' => 'User Session',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'session'             => 'Session',
            'session_helper'      => ' ',
            'service_code'        => 'Service Code',
            'service_code_helper' => ' ',
            'msisdn'              => 'Msisdn',
            'msisdn_helper'       => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'team' => [
        'title'          => 'Teams',
        'title_singular' => 'Team',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'owner'             => 'Owner',
            'owner_helper'      => ' ',
        ],
    ],
];
