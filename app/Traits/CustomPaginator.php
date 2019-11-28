<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

trait CustomPaginator{

    /**
     * Paginates collection
     */
    public function paginate($collection, $perPage){
        $pageStart           = request('page', 1);
        $offSet              = ($pageStart * $perPage) - $perPage;
        $itemsForCurrentPage = $collection->slice($offSet, $perPage);

        $output = new LengthAwarePaginator(
            $itemsForCurrentPage, $collection->count(), $perPage,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]
        );

        return $output->appends(request()->input());
    }

}