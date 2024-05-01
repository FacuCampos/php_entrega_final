<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuario = new User();

        $usuario->name = 'admin';
        $usuario->email = 'admin@mail.com';
        $usuario->password = Hash::make('admin');

        $usuario->save();

        $usuario2 = new User();

        $usuario2->name = 'facu';
        $usuario2->email = 'facu@mail.com';
        $usuario2->password = Hash::make('facu123');

        $usuario2->save();

        $usuario3 = new User();

        $usuario3->name = 'johndoe';
        $usuario3->email = 'doe@mail.com';
        $usuario3->password = Hash::make('doe123');

        $usuario3->save();

    }
}