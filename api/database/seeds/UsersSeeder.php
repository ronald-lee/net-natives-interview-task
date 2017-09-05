<?php

use Illuminate\Database\Seeder;
use App\User;

/**
 * UsersSeeder
 * Seeder Class for seeding the database with sample Users
 * @author Ronald Lee <ronald@ronaldlee.co.uk>
 */
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $json = file_get_contents(storage_path('data/users.json'));
        $data = json_decode($json);
        foreach ($data as $user) {
            $salt = str_random(10);
            User::create([
                'email' => $user->email,
                'salt' => $salt,
                'password_hash' => app('hash')->make($user->password . $salt),
                'remember_token' => str_random(10)
            ]);
        }
    }
}
