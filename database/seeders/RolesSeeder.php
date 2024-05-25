<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $examOfficerRole = Role::where(['name' => 'Exam Officer'])->first();

        if (!$examOfficerRole) {
            // Create the "Exam Officer" role if it doesn't exist
            $examOfficerRole = Role::create(['name' => 'Exam Officer']);
        }
        // Assign the specified permissions to the "Exam Officer" role
        $examOfficerPermissions = [
            'view menu account-setup',
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
        ];

        foreach ($examOfficerPermissions as $permission) {
            $permissionInstance = Permission::where('name', $permission)->first();
            if ($permissionInstance) {
                $examOfficerRole->givePermissionTo($permissionInstance);
            }
        }
    }
}
