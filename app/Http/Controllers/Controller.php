<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *      version="2",
     *      title="iSUS documentação",
     *      description="Descrição dos endpoints",
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * ),
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="API Server",
     * ),
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function paginationResolver($data, $step, $total, $current_page)
    {
        $starting_point = ($current_page * $step) - $step;
        $data_sliced = array_slice($data, $starting_point, $step);
        $paginate = new LengthAwarePaginator($data_sliced, $total, $step, $current_page);

        return $paginate;
    }
}
