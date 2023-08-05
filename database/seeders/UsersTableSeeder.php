<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "email" => "admin@gmail.com",
            "username" => "admin",
            "password" => Hash::make("admin"),
            "role" => "admin",            
        ]);

        // User::create([
        //     // "nama"  => "Jihan",
        //     "email" => "jihan@gmail.com",
        //     "password"  => Hash::make("jihan"),
        //     "role"  => "murid",
        // ]);

        // User::create([
        //     // "nama"  => "Athaya",
        //     "email" => "athaya@gmail.com",
        //     "password"  => Hash::make("athaya"),
        //     "role"  => "tutor",
        // ]);
    }
}