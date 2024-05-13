<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //check if super admin role is already existing
        if(! Role::where('name', 'Super Admin')->exists()){
            $role = Role::create(['name' => 'Super Admin']);
        }else{
            $role = Role::where('name', 'Super Admin')->first();
        }

        $user = User::where('email', 'favourobasi6@gmail.com')->first();
        if($user && !$user->hasRole('Super Admin')){
            $user->syncRoles([$role->name]);
        }
    }
}
