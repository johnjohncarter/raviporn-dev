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
            'name' => 'Super Admin',
            'surname' => 'Suradmin',
            'password' => Hash::make('123456'),
            'email' => 'admin@gmail.com',
            'phone' => '0808528436',
            'line' => '0808528436',
            'facebook' => 'john john carter',
            'role_id' => 1,
            'role' => 'super_admin',
        ];
        User::query()->create($user);

        $user = [
            'username' => 'jack',
            'name' => 'Admin',
            'surname' => 'suradmin',
            'password' => Hash::make('123456'),
            'email' => 'jack@gmail.com',
            'phone' => '0808528436',
            'line' => '0808528436',
            'facebook' => 'john john carter',
            'role_id' => 2,
            'role' => 'admin',
        ];
        User::query()->create($user);

        $user = [
            'username' => 'john',
            'name' => 'John',
            'surname' => 'Carter',
            'password' => Hash::make('123456'),
            'email' => 'john@gmail.com',
            'phone' => '0808528436',
            'line' => '0808528436',
            'facebook' => 'john john carter',
            'role_id' => 3,
            'role' => 'user',
        ];
        User::query()->create($user);

        $user = [
            'username' => 'wiraporn',
            'name' => 'Wiraporn',
            'surname' => 'Carter',
            'password' => Hash::make('123456'),
            'email' => 'wiraporn@gmail.com',
            'phone' => '0808528436',
            'line' => '0808528436',
            'facebook' => 'wiraporn carter',
            'role_id' => 3,
            'role' => 'user',
        ];
        User::query()->create($user);
    }
}
