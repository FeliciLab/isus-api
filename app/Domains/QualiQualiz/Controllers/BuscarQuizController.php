<?php
declare(strict_types = 1);

namespace App\Domains\QualiQualiz\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuscarQuizController extends Controller
{
    public function buscarQuiz(Request $request, int $codQuiz) {
        return response()->json(
            [],
            200
        );
    }
}
