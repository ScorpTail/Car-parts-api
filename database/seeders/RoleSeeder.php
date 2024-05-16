<?php

namespace Database\Seeders;

use App\Enum\RoleEnum;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'name' => RoleEnum::ADMIN->name,
            'slug' => RoleEnum::ADMIN->name,
        ]);
        DB::table('roles')->insert([
            'name' => RoleEnum::MODERATOR->name,
            'slug' => RoleEnum::MODERATOR->name,
        ]);
        DB::table('roles')->insert([
            'name' => RoleEnum::USER->name,
            'slug' => RoleEnum::USER->name,
        ]);
    }
}
