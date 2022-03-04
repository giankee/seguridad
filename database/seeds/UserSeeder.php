<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstName' => 'pruebaF',
            'lastName' => 'pruebaN',
            'dni' => '12345678G',
            'email' => 'seguridadweb@campusviu.es',
            'password' => Hash::make('S3gur1d4d?W3b'),
            'confirm_password' => Hash::make('S3gur1d4d?W3b'),
            'iban' => 'ES9121000418450200051332',
            'telephone' => '+593999786121',
            'country' => 'Ecuador',
            'personal_info' => 'esto es un usuario de prueba',
        ]);
    }
}