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
            'username' => 'tawan',
            'name' => 'ตะวัน',
            'surname' => 'คนหล่อ',
            'password' => Hash::make('123456'),
            'email' => 'tawan@gmail.com',
            'phone' => '0808528436',
            'line' => '0808528436',
            'facebook' => '',
            'role_id' => 2,
            'role' => 'admin',
        ];
        User::query()->create($user);

        $user = [
            'username' => 'aon',
            'name' => 'อ้น',
            'surname' => 'คนหล่อ',
            'password' => Hash::make('123456'),
            'email' => 'aon@gmail.com',
            'phone' => '0808528436',
            'line' => '0808528436',
            'facebook' => '',
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
            'role_id' => 1,
            'role' => 'super_admin',
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
            'role_id' => 1,
            'role' => 'super_admin',
        ];
        User::query()->create($user);

        $user = [
            'username' => 'measangtong',
            'name' => 'แม่แสงทอง',
            'surname' => 'มันฝรั่งไซต์ A B',
            'password' => Hash::make('123456'),
            'email' => 'measangtong@gmail.com',
            'phone' => '',
            'line' => '',
            'facebook' => '',
            'role_id' => 3,
            'role' => 'user',
        ];
        User::query()->create($user);

        $user = [
            'username' => 'meanong',
            'name' => 'แม่น้อย',
            'surname' => 'มันฝรั่งไซต์ A',
            'password' => Hash::make('123456'),
            'email' => 'meanong@gmail.com',
            'phone' => '',
            'line' => '',
            'facebook' => '',
            'role_id' => 3,
            'role' => 'user',
        ];
        User::query()->create($user);

        $user = [
            'username' => 'eak',
            'name' => 'พี่เอก',
            'surname' => 'มันฝรั่งไซต์ O',
            'password' => Hash::make('123456'),
            'email' => 'eak@gmail.com',
            'phone' => '',
            'line' => '',
            'facebook' => '',
            'role_id' => 3,
            'role' => 'user',
        ];
        User::query()->create($user);
    }
}
