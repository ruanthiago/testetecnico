<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            ['name' => 'Admin', 'email' => 'admin@admin.com', 'password' => '$2y$10$uCMTSNg0E257EglKdMOZy.u.wynrj3RCPhw3i9RfPoiryWC0RM.U6'],
        ]);
    }
}
