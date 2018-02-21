<?php

use App\Channel;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1 = ['title' => 'Laravel 5', 'slug' => 'laravel-5'];
        $channel2 = ['title' => 'Vue JS', 'slug' => 'vue-js'];
        $channel3 = ['title' => 'Front-end HTML5/CSS3/JS', 'slug' => 'front-end-html5-css3-js'];
        $channel4 = ['title' => 'Database', 'slug' => 'database'];
        $channel5 = ['title' => 'JS frameworks Angular/React...', 'slug' => 'js-framework-angular-react'];

        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
        Channel::create($channel5);
    }
}
