<?php

namespace Database\Seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Statement;
use mysql_xdevapi\Table;

class UserSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->disableForeignKeys();
//        DB::table('users')->truncate();
        $this->truncate('users');
        User::factory(10)->create();
//        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $this->enableForeignKeys();
    }
}
