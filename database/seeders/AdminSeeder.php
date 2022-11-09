<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateorcreate(
            ['id' => 1],
            [
                'id' => 1,
                'name' => "Admin",
                'email' => "admin@digital-club.com",
                'password' => Hash::make('123123123'),
                'email_verified_at' => Carbon::now(),
            ]
        );
    }
}
