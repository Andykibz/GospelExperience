<?php

use Illuminate\Database\Seeder;
use App\MediaType;
use App\Page;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MediaType::create(['type'=>'Audio','slug'=>'audio'] );
        MediaType::create(['type'=>'Image','slug'=>'image'] );
        MediaType::create(['type'=>'Video','slug'=>'video'] );
        // MediaType::create(['name'=>'Instagram','slug'=>'instagram'] );
        // MediaType::create(['name'=>'Facebook','slug'=>'facebook'] );
        Page::create([ 'title'=>'About GospelExperience', 'slug'=>'about-us', 'body'=>'']);
        Page::create([ 'title'=>'Terms and Conditions', 'slug'=>'terms-and-conditions', 'body'=>'']);
        Page::create([ 'title'=>'Privacy Policy', 'slug'=>'privacy-policy', 'body'=>'']);
        Page::create([ 'title'=>'Site Description', 'slug'=>'site-description', 'body'=>'']);
    }
}
