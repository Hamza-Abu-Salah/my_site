<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'key' => 'instagram',
                'value' => 'https://www.instagram.com/ali_qrinawi/',
                'label_en' => 'Instagram',
                'label_ar' => 'أنستقرام',
                'type' => 'text',
                'group' => 'social',
            ],
            [
                'key' => 'facebook',
                'value' => '132',
                'label_en' => 'Facebook',
                'label_ar' => 'فيس بوك',
                'type' => 'text',
                'group' => 'social',
            ],
            [
                'key' => 'twitter',
                'value' => '123123',
                'label_en' => 'Twitter',
                'label_ar' => 'تويتر',
                'type' => 'text',
                'group' => 'social',
            ],
            [
                'key' => 'github',
                'value' => '123123',
                'label_en' => 'Github',
                'label_ar' => 'قت هب',
                'type' => 'text',
                'group' => 'social',
            ],
            [
                'key' => 'youTube',
                'value' => '1321',
                'label_en' => 'YouTube',
                'label_ar' => 'اليوتيوب',
                'type' => 'text',
                'group' => 'social',
            ],
            [
                'key' => 'whatsapp',
                'value' => '1321',
                'label_en' => 'Whatsapp',
                'label_ar' => 'واتس أب',
                'type' => 'text',
                'group' => 'social',
            ],
            [
                'key' => 'email',
                'value' => '1321',
                'label_en' => 'E-mail',
                'label_ar' => 'البريد الإلكتروني',
                'type' => 'text',
                'group' => 'social',
            ],
            [
                'key' => 'address',
                'value' => '1321',
                'label_en' => 'Address',
                'label_ar' => 'العنوان',
                'type' => 'text',
                'group' => 'social',
            ],
        ];


        foreach ($data as $key => $value) {
            Setting::create([
                'key' => $value['key'],
                'value' => $value['value'],
                'label_en' => $value['label_en'],
                'label_ar' => $value['label_ar'],
                'type' => $value['type'],
                'group' => $value['group'],
            ]);
        }
    }
}
