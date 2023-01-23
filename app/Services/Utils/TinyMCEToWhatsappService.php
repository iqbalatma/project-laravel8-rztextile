<?php

namespace App\Services\Utils;

class TinyMCEToWhatsappService
{
    public static function translate(string $message)
    {
        $message = preg_replace('/<p>|<\/p>/', '', $message);
        $message = preg_replace('/<strong>|<\/strong>/', '*', $message);
        $message = preg_replace('/<em>|<\/em>/', '_', $message);
        $message = preg_replace('/&nbsp;/', '', $message);
        return $message;
    }
}
