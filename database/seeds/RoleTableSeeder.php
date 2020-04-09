<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'description' => 'ผุ้ดูแลระบบทั้งหมด',
            ],
            [
                'name' => 'staff',
                'description' => 'พนักงาน',
            ],
            [
                'name' => 'customer',
                'description' => 'ลูกค้า',
            ],
            [
                'name' => 'gardener',
                'description' => 'ลูกสวน',
            ],
        ];
        foreach ($roles as $role)
            \App\Models\Role::query()->create($role);
    }
}
