<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'username' => 'admin',
            'name' => 'admin',
            'surname' => 'suradmin',
            'password' => Hash::make('123456'),
            'email' => 'admin@gmail.com',
            'phone' => '0808528436',
            'line' => '0808528436',
            'facebook' => 'john john carter',
            'role_id' => 1,
            'role' => 'admin',
        ];
        User::query()->create($user);
    }
}
