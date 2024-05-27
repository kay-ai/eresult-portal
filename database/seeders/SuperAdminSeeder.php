<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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

        $user = User::where('email','emmanuelayeh1@gmail.com')->first();

        if(!$user){
            $user = new User();
            $user->first_name = 'Emmanuel';
            $user->last_name = 'Ayeh';
            $user->email = 'emmanuelayeh1@gmail.com';
            $user->phone_number = '09053143790';
            $user->password = Hash::make('12345678');
            $user->account_id = 1;
            $user->save();
        }

        if($user && !$user->hasRole('Super Admin')){
            $user->syncRoles([$role->name]);
        }
    }
}
