<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CommonSettingsTableSeeder extends Seeder
{    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings__lists')->insert([
            'setting_key' => 'adminTheme',
            'setting_value' => 'indigo',
            'setting_type' => 'prod'
        ]);      
        DB::table('settings__lists')->insert([
            'setting_key' => 'adminRecordPerPage',
            'setting_value' => '10',
            'setting_type' => 'prod'
        ]);      
    }
}
