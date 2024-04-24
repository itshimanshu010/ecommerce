<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'name' => 'Himanshu Jaiswal',
            'email' => 'admin@admin.com',
            'password' =>bcrypt('password')
        ];
        Admin::create($admin);
    }
}
