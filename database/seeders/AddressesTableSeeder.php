<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1Id = cache()->get('user1_id');
        $user2Id = cache()->get('user2_id');

        DB::table('addresses')->insert([
            [
                'postal_code' => '86188-000',
                'street' => 'Coronel João Gualberto',
                'number' => '739',
                'additional_information'=> 'Casa',
                'neighborhood' => 'Jardim Silvino',
                'city' => 'Londrina',
                'state' => 'Paraná',
                'country' => 'Brasil',
                'user_id' => $user1Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'postal_code' => '86188-000',
                'street' => 'Coronel João Gualberto',
                'number' => '739',
                'additional_information'=> 'Casa',
                'neighborhood' => 'Jardim Silvino',
                'city' => 'Londrina',
                'state' => 'Paraná',
                'country' => 'Brasil',
                'user_id' => $user2Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
