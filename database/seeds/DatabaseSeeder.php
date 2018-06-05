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
        $user = App\User::create([
            'username' => "test",
            'email' => "test@gmail.com",
            'full_name' => "test",
            'phone_number' => "0812345678",
            'position' => 'Member',
            'password' => password_hash("tester", PASSWORD_DEFAULT),
        ]);
        $setting_item = App\Setting_item::create([
            'user_id' => $user->id
        ]);
        App\Setting_item_option_check::create([
            'setting_item_id' => $setting_item->id,
            'name' => 'Checked'
        ]);
        App\Setting_item_option_check::create([
            'setting_item_id' => $setting_item->id,
            'name' => 'Moved'
        ]);
        App\Item::create([
            'user_id' => 2,
            'name' => 'Chair',
            'description' => 'In living room.',
            'width' => 77.8,
            'length' => 107.4,
            'height' => 76.5,
            'image_path' => './images/items/chair.jpg',
        ]);
    }
}
