<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'view menu account-setup',
            'view sub-menu basic-info',
            'view sub-menu academic-session',
            'view sub-menu schools',
            'view sub-menu departments',
            'view sub-menu levels',
            'view sub-menu courses',
            'view sub-menu exam-officers',
            'view sub-menu grade-settings',
            'view menu students',
            'view sub-menu enroll-students',
            'view sub-menu all-students',
            'view menu results',
            'view sub-menu upload-results',
            'view sub-menu all-results',
            'view sub-menu students-transcripts',
            'view menu statistics',
            'view sub-menu results',
            'view sub-menu course-performances',
            'view menu settings',
            'view sub-menu roles',
            'view sub-menu permissions',
            'view sub-menu assign-role',
            'view sub-menu assign-permission',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
