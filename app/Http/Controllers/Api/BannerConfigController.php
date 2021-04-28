<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\BannerConfig;
use App\Service\BannerConfigService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BannerConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param BannerConfigService $bannerConfigService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(BannerConfigService $bannerConfigService)
    {
        return response()->json(
            $bannerConfigService->buscarConfiguracoes()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param BannerConfigService $bannerConfigService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, BannerConfigService $bannerConfigService)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'titulo' => 'required',
                'imagem' => 'required',
                'valor' => 'required',
                'tipo' => 'required',
                'ordem' => 'required',
                'options' => 'required',
                'ativo' => 'required',
            ]
        );

        if ($validation->fails()) {
            return response()->json(
                $validation->errors(),
                Response::HTTP_BAD_REQUEST
            );
        }

        return response()
            ->json(
                $bannerConfigService->salvar($request->all()),
                201
            );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        return response()->json(BannerConfig::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @param BannerConfigService $bannerConfigService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(
        Request $request,
        int $id,
        BannerConfigService $bannerConfigService
    ) {
        return response()
            ->json(
                $bannerConfigService->salvar(
                    $request->all(),
                    BannerConfig::findOrFail($id)
                )
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        return response()->json(
            BannerConfig::findOrFail($id)->delete(),
            204
        );
    }
}
