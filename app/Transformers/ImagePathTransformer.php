<?php


namespace App\Transformers;


class ImagePathTransformer
{
    public static function getUrl(?string $image_path)
    {
        if (!$image_path) {
            return null;
        }
        return config('app.url') . '/uploads/' . $image_path;
    }
}