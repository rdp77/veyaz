<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seo')->insert([
            [
                'name' => Str::upper('site_title'),
                'value' => 'Veyaz',
                'is_active' => true
            ],
            [
                'name' => Str::upper('site_description'),
                'value' => 'Veyaz is a free and open source Laravel Admin Dashboard 
                Template for any platform, Web application development, eCommerce, CRM, CMS, etc',
                'is_active' => true
            ],
            [
                'name' => Str::upper('site_keywords'),
                'value' => 'wreative, laravel, cms, free, open source, admin dashboard, web development, 
                ecommerce, crm, cms, etc',
                'is_active' => true
            ],
            [
                'name' => Str::upper('site_author'),
                'value' => 'Moh Ravi Dwi Putra',
                'is_active' => true
            ],
            [
                'name' => Str::upper('site_author_url'),
                'value' => 'https://ravidwiputra.my.id',
                'is_active' => true
            ],
            [
                'name' => Str::upper('site_publisher'),
                'value' => 'Moh Ravi Dwi Putra',
                'is_active' => true
            ],
            [
                'name' => Str::upper('theme_color'),
                'value' => '#3F51B5',
                'is_active' => true
            ],
            [
                'name' => Str::upper('site_icon'),
                'value' => 'https://via.placeholder.com/300x300',
                'is_active' => true
            ],
            [
                'name' => Str::upper('site_image'),
                'value' => 'https://via.placeholder.com/300x300',
                'is_active' => true
            ],
            [
                'name' => Str::upper('google_site_verification'),
                'value' => '#',
                'is_active' => true
            ],
            [
                'name' => Str::upper('bing_site_verification'),
                'value' => '#',
                'is_active' => true
            ],
            [
                'name' => Str::upper('yandex_site_verification'),
                'value' => '#',
                'is_active' => true
            ],
            [
                'name' => Str::upper('dmca_site_verification'),
                'value' => '#',
                'is_active' => true
            ],
            [
                'name' => Str::upper('twitter_username'),
                'value' => '#',
                'is_active' => true
            ],
        ]);
    }
}