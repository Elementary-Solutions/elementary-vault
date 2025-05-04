<?php

namespace Database\Seeders;

use Database\Seeders\Default\FileMimeTypeSeeder;
use Database\Seeders\Default\FileTypeSeeder;
use Database\Seeders\Default\PartnerSeeder;
use Database\Seeders\Default\ProviderAdapterSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            PartnerSeeder::class,
            FileTypeSeeder::class,
            FileMimeTypeSeeder::class,
            ProviderAdapterSeeder::class
        ]);
    }
}
