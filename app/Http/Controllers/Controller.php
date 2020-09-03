<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function paginationResolver($data, $step, $total, $current_page)
    {
        $starting_point = ($current_page * $step) - $step;
        $data_sliced = array_slice($data, $starting_point, $step);
        $paginate = new LengthAwarePaginator($data_sliced, $total, $step, $current_page);

        return $paginate;
    }
}
