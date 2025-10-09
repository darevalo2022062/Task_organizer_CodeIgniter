<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class Locale extends Controller
{
    public function switch(string $locale)
    {
        $allowed = config(('App'))->supportedLocales;
        if (!in_array($locale, $allowed, true)) {
            $locale = config('App')->defaultLocale;
        }

        session()->set('lang', $locale);
        return redirect()->back();
    }
}