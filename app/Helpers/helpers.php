<?php

use Illuminate\Support\Facades\Request;

if(!function_exists('sort_url')) { 
    function sort_url(string $column){  
        $currentSort = request('sort');
        $currentDirectiory = request('direction');

        $direction = ($currentSort === $column && $currentDirectiory === 'asc') ? 'desc' : 'asc';

        return request()->fullUrlWithQuery([
            'sort' => $column,
            'direction' => $direction
        ]);


    }
}