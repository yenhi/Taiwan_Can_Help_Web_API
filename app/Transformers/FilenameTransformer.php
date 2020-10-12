<?php


namespace App\Transformers;


use App\Generators\FilenameGenerator;

class FilenameTransformer
{
    public static function get()
    {
        return function ($file) {
            return FilenameGenerator::get() . '.' . $file->guessExtension();
        };
    }
}