<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'user_type' => 'admin',
        ]);

        User::insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'user_type' => 'user',
        ]);

        Company::insert([
            'name' => 'Mars Corporation',
            'email' => 'marsha@enterprise.com',
            'logo' => 'storage/Mars Corporation.jpg',
            'website' => 'www.MC.com',
        ]);

        Company::insert([
            'name' => 'G Corporation',
            'email' => 'g@enterprise.com',
            'logo' => 'storage/G Corporation.jpg',
            'website' => 'www.GCorp.com',
        ]);

        Employee::factory(12)->create();

    }
}
