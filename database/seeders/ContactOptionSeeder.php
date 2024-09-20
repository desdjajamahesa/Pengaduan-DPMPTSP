<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactOption;

class ContactOptionSeeder extends Seeder
{
    public function run()
    {
        $contacts = [
            ['type' => 'whatsapp', 'value' => 'https://wa.me/6281293984743'],
            ['type' => 'email', 'value' => 'smaasmerul@gmail.com'],
            ['type' => 'phone', 'value' => '+6281293984743'],
            ['type' => 'meeting', 'value' => '#'],
        ];

        foreach ($contacts as $contact) {
            ContactOption::updateOrCreate(['type' => $contact['type']], ['value' => $contact['value']]);
        }
    }
}
