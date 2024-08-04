<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = Role::create(['name' => 'user']);
        $admin = Role::create(['name' => 'admin']);

        Permission::create(['name' => 'task list']);
        Permission::create(['name' => 'search task']);
        Permission::create(['name' => 'create task']);
        Permission::create(['name' => 'update task']);
        Permission::create(['name' => 'destroy task']);

        $user->givePermissionTo(['task list', 'search task']);
        $admin->givePermissionTo(['task list', 'search task', 'create task', 'update task', 'destroy task']);

        $admin = User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password')]);
        $admin->assignRole('admin');
        $user = User::create(['name' => 'User', 'email' => 'user@example.com', 'password' => bcrypt('password')]);
        $user->assignRole('user');
    }
}
