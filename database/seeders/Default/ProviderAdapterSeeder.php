<?php

namespace Database\Seeders\Default;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProviderAdapterSeeder extends Seeder
{
    public function run(): void
    {
        $adapters = [
            // Existentes
            ['partner_id' => 1, 'name' => 'local_storage',   'enabled' => true],
            ['partner_id' => 1, 'name' => 'ftp_storage',     'enabled' => false], // FTP genérico
            ['partner_id' => 2, 'name' => 'google_drive',    'enabled' => true],
            ['partner_id' => 2, 'name' => 'gcs',             'enabled' => false], // Google Cloud Storage
            ['partner_id' => 3, 'name' => 'one_drive',       'enabled' => true],
            ['partner_id' => 3, 'name' => 'azure_blob',      'enabled' => false], // Azure Blob
            ['partner_id' => 4, 'name' => 'aws_s3',          'enabled' => false],
            ['partner_id' => 5, 'name' => 'oracle_oci',      'enabled' => false],
            ['partner_id' => 6, 'name' => 'dropbox',         'enabled' => false],
            ['partner_id' => 7, 'name' => 'Mega_nz',         'enabled' => false], // Mega
        ];

        DB::table('provider_adapters')->insert($adapters);
        DB::table('provider_adapters')->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
    }
}
