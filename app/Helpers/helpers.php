<?php

use Stichoza\GoogleTranslate\GoogleTranslate;

if (!function_exists('gtranslate')) {
    function gtranslate($text, $locale = null)
    {
        try {
            $locale = $locale ?? session('locale', 'vi');

            $tr = new \Stichoza\GoogleTranslate\GoogleTranslate($locale);
            $tr->setSource(null);
            return $tr->translate($text);
        } catch (\Exception $e) {
            return $text;
        }
    }
}

