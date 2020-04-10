<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create doctor']);
        Permission::create(['name' => 'create pharmacy']);
        Permission::create(['name' => 'update pharmacy']);
        Permission::create(['name' => 'delete pharmacy']);
    }
}
