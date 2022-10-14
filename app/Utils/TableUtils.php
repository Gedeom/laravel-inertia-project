<?php

namespace App\Utils;

use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Collection;

class TableUtils {
    public static function makeGlobalSearch(array $columns):AllowedFilter {

        $globalSearch = AllowedFilter::callback('global', function ($query, $value) use ($columns) {
            $query->where(function ($query) use ($value, $columns) {
                Collection::wrap($value)->each(function ($value) use ($query, $columns) {
                    foreach($columns as $column){
                        $query
                        ->orWhere($column, 'LIKE', "%{$value}%");
                    }
                });
            });
        });

        return $globalSearch;
    }
}