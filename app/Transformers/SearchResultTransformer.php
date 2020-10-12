<?php


namespace App\Transformers;

use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SearchResultTransformer
{
    public static function format(LengthAwarePaginator $paginator, Closure $dataClosure = null)
    {
        $data = $paginator->items();
        if ($dataClosure) {
            $data = collect($data)
                ->map(function ($data) use ($dataClosure) {
                    return $dataClosure($data);
                });
        }
        return [
            'total' => $paginator->total(),
            'current_page' => $paginator->currentPage(),
            'number_per_page' => $paginator->perPage(),
            'data' => $data,
        ];
    }
}