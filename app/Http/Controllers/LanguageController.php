<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function switch($locale)
    {  
        // dd($locale,  config('app.supported_locales'), in_array($locale, config('app.supported_locales')));
        if (in_array($locale, config('app.supported_locales'))) {
            session(['locale' => $locale]);
            // App::setLocale($locale);
        }

        return redirect()->back();
    }
}
