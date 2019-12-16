<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesAndPermissionsTables extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array([
            'name' => 'Admin',
            'display_name' => 'Admin',
            'description' => 'Admin',
        ],
        [
            'name' => 'Customer',
            'display_name' => 'Customer',
            'description' => 'Customer',
        ]);
        DB::table('roles')->insert($roles);

        $roles = array([
            'name' => 'home',
            'display_name' => 'home',
            'description' => 'home',
        ],
        [
            'name' => 'login',
            'display_name' => 'login',
            'description' => 'login',
        ],
        [
            'name' => 'logout',
            'display_name' => 'logout',
            'description' => 'logout',
        ],
        [
            'name' => 'password.email',
            'display_name' => 'password.email',
            'description' => 'password.email',
        ],
        [
            'name' => 'password.update',
            'display_name' => 'password.update',
            'description' => 'password.update',
        ],
        [
            'name' => 'password.reset',
            'display_name' => 'password.reset',
            'description' => 'password.reset',
        ],
        [
            'name' => 'register',
            'display_name' => 'register',
            'description' => 'register',
        ]);
        DB::table('permissions')->insert($roles);

        $roles = array([
            'permission_id' => '1',
            'role_id' => '1',
        ],
        [
            'permission_id' => '1',
            'role_id' => '2',
        ],
        [
            'permission_id' => '2',
            'role_id' => '2',
        ],
        [
            'permission_id' => '2',
            'role_id' => '1',
        ],
        [
            'permission_id' => '3',
            'role_id' => '1',
        ],
        [
            'permission_id' => '3',
            'role_id' => '2',
        ]);
        DB::table('permission_role')->insert($roles);
    }
}
