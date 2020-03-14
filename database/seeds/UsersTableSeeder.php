<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'natnael.awel@gmail.com')->first();
        if(!$user){
            User::create([
                'name'=>'Nathaniel',
                'email'=>'natnael.awel@gmail.com',
                'password'=> Hash::make('natiawel'),
                'role' => 'admin'
            ]);
        }
    }
}
