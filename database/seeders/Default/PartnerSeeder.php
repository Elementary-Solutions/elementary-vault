<?php

namespace Database\Seeders\Default;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('provider_partners')->insert([
            ['name' => 'Local'],
            ['name' => 'Google'],
            ['name' => 'Microsoft'],
            ['name' => 'Amazon AWS'],
            ['name' => 'Oracle'],
            ['name' => 'Dropbox'],
            ['name' => 'Mega'],
        ]);

        DB::table('provider_partners')->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
    }
}
