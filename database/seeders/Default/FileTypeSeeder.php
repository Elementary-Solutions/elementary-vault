<?php

namespace Database\Seeders\Default;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('file_types')->insert([
            ['id' => 1, 'name' => 'image'],
            ['id' => 2, 'name' => 'video'],
            ['id' => 3, 'name' => 'audio'],
            ['id' => 4, 'name' => 'document'],
            ['id' => 5, 'name' => 'spreadsheet'],
            ['id' => 6, 'name' => 'presentation'],
            ['id' => 7, 'name' => 'code'],
            ['id' => 8, 'name' => 'font'],
            ['id' => 9, 'name' => 'model'],
            ['id' => 10, 'name' => 'data'],
            ['id' => 11, 'name' => 'script'],
            ['id' => 12, 'name' => 'compressed'],
            ['id' => 13, 'name' => 'executable'],
            ['id' => 14, 'name' => 'other'],
        ]);

        DB::table('file_types')->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
    }   

}