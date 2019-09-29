<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        $role = Role::create(['name' => 'Super-admin']);
        $role = Role::create(['name' => 'Restaurant']);
        $role = Role::create(['name' => 'Supplier']);
        $role = Role::create(['name' => 'Branch']);
//        $permission = Permission::create(['name' => 'edit articles']);

    }
}
