<?php
declare(strict_types = 1);

namespace App\Domains\QualiQuiz\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuscaQuizController extends Controller
{
    public function buscarQuiz(Request $request, int $codQuiz) {
        return response()->json(
            [],
            200
        )
    }
}
