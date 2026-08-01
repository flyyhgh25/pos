<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {

    public function run():void{
        User::updateOrCreate(
            ['email'=>'admin@gmail.com'],
            [
                'name'=>'Admin Master',
                'password'=> Hash::make('admin2026'),
            ]
        );
    }
}
