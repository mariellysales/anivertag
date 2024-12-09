<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $user1_id = DB::table('users')->insertGetId([
            'name' => 'Marielly Sales de Moraes',
            'cpf' => '011.377.811-22',
            'email' => 'mariellysales01@gmail.com',
            'birth_date' => '2001-06-09',
            'main_phone' => '(64)99326-4309',
            'reference_contact_name' => 'Leonardo',
            'reference_contact' => '(43)99182-1340',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user2_id = DB::table('users')->insertGetId([
            'name' => 'Leonardo Henrique Cardoso',
            'cpf' => '113.319.149-57',
            'email' => 'leohenricardoso@gmail.com',
            'birth_date' => '2000-04-22',
            'main_phone' => '(43)9182-1340',
            'reference_contact_name' => 'Marielly',
            'reference_contact' => '(64)99326-4309',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('addresses')->insert([
            [
                'postal_code' => '86188-00',
                'street' => 'Coronel João Gualberto',
                'number' => '739',
                'additional_information'=> 'Casa',
                'neighborhood' => 'Jardim Silvino',
                'city' => 'Londrina',
                'state' => 'Paraná',
                'country' => 'Brasil',
                'user_id' => $user1_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'postal_code' => '86188-00',
                'street' => 'Coronel João Gualberto',
                'number' => '739',
                'additional_information'=> 'Casa',
                'neighborhood' => 'Jardim Silvino',
                'city' => 'Londrina',
                'state' => 'Paraná',
                'country' => 'Brasil',
                'user_id' => $user2_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}