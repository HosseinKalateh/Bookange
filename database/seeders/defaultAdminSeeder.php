<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;  

class defaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert default admin
        
        \DB::table('users')->insert([
            'name' => 'default admin',
            'email' => 'admin@bookange.com',
            'is_superuser' => true,
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
