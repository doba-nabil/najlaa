<?php

use Illuminate\Database\Seeder;
use App\Models\Moderator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Moderator::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'status' => 1,
            'password' => bcrypt('123456789')
        ]);

        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
