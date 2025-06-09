<?php

namespace Database\Seeders;

use App\Enums\ProfileEnum;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profileAdmin = Profile::factory()
            ->create([
                'name' => ProfileEnum::ADMIN->value,
            ]);

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $user->profiles()->attach($profileAdmin);
    }
}
