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
        $sioc = App\Setting_item_option_check::create([
            'setting_item_id' => $setting_item->id,
            'name' => 'Checked',
            'status' => 1
        ]);
        $sioc2 = App\Setting_item_option_check::create([
            'setting_item_id' => $setting_item->id,
            'name' => 'Moved',
            'status' => 1
        ]);
        $item = App\Item::create([
            'user_id' => $user->id,
            'name' => 'Chair',
            'description' => 'In living room.',
            'width' => 77.8,
            'length' => 107.4,
            'height' => 76.5,
            'image_name' => 'chair.jpg',
        ]);
        App\Items_option_check::create([
            'item_id' => $item->id,
            'setting_item_option_check_id' => $sioc->id,
        ]);
        App\Items_option_check::create([
            'item_id' => $item->id,
            'setting_item_option_check_id' => $sioc2->id,
        ]);
    }
}
