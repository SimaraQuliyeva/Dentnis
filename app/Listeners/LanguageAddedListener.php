<?php

namespace App\Listeners;

use App\Events\LanguageAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class LanguageAddedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LanguageAdded $event): void
    {
//        $image = $event->image;
//        $lang = $event->lang;
////        dd($lang);
//
//        // Dil bilgilerini config dosyasına ekleyin
//        $config = config('app');
//        $config['languages'][$lang] = $image;
//        Config::set('app', $config);
//        // Artisan komutu ile config:cache işlemi yapın
//        Artisan::call('config:cache');
            //
    }
}
