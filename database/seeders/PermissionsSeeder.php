<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view dashboard',

            'view menu account set-up',
            'view sub-menu basic-info',
            'view sub-menu academic-session',
            'view sub-menu faculties',
            'view sub-menu departments',
            'view sub-menu levels',
            'view sub-menu courses',
            'view sub-menu exam-officers',
            ''
        ];

        foreach($permissions as $permission){
            if(Permission::where('name', $permission)->exists()){
                continue;
            }
            Permission::create([
                'name' => $permission
            ]);
        }

        //handle it here
    }
}
