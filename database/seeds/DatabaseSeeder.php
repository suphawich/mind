<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $user = new App\User;
        // $user->username = "admin";
        // $user->email = "admin@mind";
        // $user->full_name = "Suphawich Sungkhavorn";
        // $user->phone_number = "0836429451";
        // $user->password = password_hash("password", PASSWORD_DEFAULT);
        // $user->save();
        App\User::create([
            'username' => "admin",
            'email' => "admin@mind",
            'full_name' => "Suphawich Sungkhavorn",
            'phone_number' => "0836429451",
            'position' => 'Administrator',
            'password' => password_hash("password", PASSWORD_DEFAULT),
        ]);
    }
}
