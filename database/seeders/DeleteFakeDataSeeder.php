<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeleteFakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example: Delete all customers with an email containing 'fake'
        DB::table('customers')->where('email', 'like', '%fake%')->delete();
    }
}
