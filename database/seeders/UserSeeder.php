<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role' => 'lector',
            'name' => 'lector',
            'nick' => 'lector',
            'surname' => 'lector',
            'image' => 'avatar.jpeg',
            'name' => 'lector',
            'email' => 'lector@notishot.com',
            'email_verified_at'=>'',
            'password' => Hash::make('lector'),
            'remember_token' =>'',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
            ]);
        User::create([
            'role' => 'redactor',
            'name' => 'redactor',
            'nick' => 'redactor',
            'surname' => 'redactor',
            'image' => 'avatar.jpeg',
            'name' => 'redactor',
            'email' => 'redactor@notishot.com',
            'email_verified_at'=>'',
            'password' => Hash::make('redactor'),
            'remember_token' =>'',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
            ]);
        User::create([
            'role' => 'administrador',
            'name' => 'administrador',
            'nick' => 'administrador',
            'surname' => 'administrador',
            'image' => 'avatar.jpeg',
            'name' => 'administrador',
            'email' => 'administrador@notishot.com',
            'email_verified_at'=>'',
            'password' => Hash::make('administrador'),
            'remember_token' =>'',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
            ]);
    }
}
