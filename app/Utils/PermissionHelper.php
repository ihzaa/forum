<?php

namespace App\Utils;

class PermissionHelper
{
    const SPECIAL_PERMISSIONS = [
        // name => description
        'Super-Admin' => 'Bypass all permissions, for Administrators only',
    ];

    const ACTIONS = [
        'view', 'create', 'update', 'delete', 'restore'
    ];
    /**
     * Permission rule:
     *
     * 1. you can set to string, but the action will use the default actions
     * 2. you can set to array with 3 following keys:
     *  2.a. name (mandatory) => The name of the permission, this will stored in database. Use this for middleware
     *  2.b. alias (optional) => The display name of permission in permission page
     *  2.c. actions (optional) => The actions for this permission. If not set, will use default actions
     *  2.d. description (optional) => The description of this permission
     */
    const PERMISSIONS = [
        'Pengaturan_User' => [
            'Pengaturan_User_Perizinan',
            'Pengaturan_User_User',
            [
                'name' => 'pengaturan_user_test',
                'alias' => 'User Testtt',
                'actions' => ['view', 'approve', 'reject', 'print'],
                'description' => 'Ini testing aja'
            ]
        ],
        'master' => [
            [
                'name' => 'master_apagitu'
            ]
        ]
    ];
}
