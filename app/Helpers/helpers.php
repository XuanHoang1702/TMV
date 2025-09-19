<?php

use Stichoza\GoogleTranslate\GoogleTranslate;

if (!function_exists('gtranslate')) {
    function gtranslate($text, $locale = 'en')
    {
        try {
            $tr = new GoogleTranslate($locale);
            $tr->setSource(null);
            return $tr->translate($text);
        } catch (\Exception $e) {
            return $text;
        }
    }
}
