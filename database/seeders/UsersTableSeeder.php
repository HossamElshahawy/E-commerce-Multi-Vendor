<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
            //admin
            'full_name'=>'hossam Admin',
            'username'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('admin'),
            'role'=>'admin',
            'status'=>'active'
            ],
            [
                //vendor
                'full_name'=>'hossam seller',
                'username'=>'seller',
                'email'=>'seller@gmail.com',
                'password'=>Hash::make('seller'),
                'role'=>'seller',
                'status'=>'active'
            ],
            //customer
            [
            'full_name'=>'hossam customer',
            'username'=>'customer',
            'email'=>'customer@gmail.com',
            'password'=>Hash::make('customer'),
            'role'=>'customer',
            'status'=>'active'
                ]
        ]);
    }
}
