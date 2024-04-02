<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function(){
            Role::create(['name'=>'admin']);
            $user=\App\Models\User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => 'admin@123',
            ]);
            $user->assignRole('admin');
        });
    }
}
