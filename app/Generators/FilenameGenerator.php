<?php


namespace App\Generators;


use Illuminate\Support\Str;

class FilenameGenerator
{
    public static function get()
    {
        return now()->format('YmdH') . Str::random('10');
    }
}