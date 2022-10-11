<?php

use Illuminate\Database\Seeder;
use App\Models\Web_setting;
class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Web_setting::updateOrCreate([
            'id' => 1,
            'title_ar' => "تحفيظ",
            'title_en' => "Tahfeez",
            'phone' => "0163646885",
            'email' => "maqrah@utq.org.sa",
            'logo_ar' => "logo_ar.png",
            'logo_en' => "logo_en.png",
            'color' => "#131315",
            'color_side_bar' => "#131315",
            'admin_logo_ar' => "admin_logo_ar.png",
            'admin_logo_en' => "admin_logo_en.png",
            'address_ar' => "محافظة عنيزة",
            'address_en' => "Unayzah Governorate",
            'about_ar' => "مقرأة قرآنية تابعة لجمعية تحفيظ القرآن الكريم بمحافظة عنيزة",
            'about_en' => "Distance education - reading - complexes - role",
            'facebook' => "https://www.facebook.com/",
            'twiter' => "https://www.facebook.com/",
            'youtube' => "https://www.facebook.com/",
            'linked_in' => "https://www.facebook.com/",
            'insta' => "https://www.facebook.com/",
            'show_mogmaa_dorr' => "0",
            'show_search_teacher' => "0",
            'show_free_subject' => "1",
            'show_fixed_subject' => "0",
            'rating' => "1",
            'show_freeze' => "1",
            'terms_ar' => "الشروط والاحكام بالعربية",
            'terms_en' => "terms and conditions in english",
        ]);
    }
}
