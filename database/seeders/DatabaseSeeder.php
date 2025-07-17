<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            KategoriUsiaSeeder::class,
            RantingSeeder::class,
            BiayaKategoriSeeder::class,
            SettingSeeder::class,
            DummyUserSeeder::class,
        ]);
    }
}
