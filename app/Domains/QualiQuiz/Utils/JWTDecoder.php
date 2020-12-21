<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Utils;

use Illuminate\Support\Collection;

/**
 * Classe para auxiliar a decodificação do jwt.
 *
 * @category Utils
 *
 * @author  Chicão Thiago <fthiagogv@gmail.com>
 * @license GPL-3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link https://github.com/EscolaDeSaudePublica/isus-api/
 */
class JWTDecoder
{
    /**
     * Remove o Bearer.
     *
     * @param $header string
     *
     * @return string
     */
    public function getJWTFromBearerHeader(string $header): string
    {
        $token = explode(
            ' ',
            $header
        );

        if (count($token) < 2) {
            return '';
        }

        return $token[1];
    }

    /**
     * Coleta o payload da string jwt.
     *
     * @param $jwt string
     *
     * @return string
     */
    public function getPayloadFromJWT(string $jwt): string
    {
        $payload = explode(
            '.',
            $jwt
        );

        if (count($payload) < 2) {
            return '';
        }

        return $payload[1];
    }

    /**
     * Converte o payload em array.
     *
     * @param $payload string
     *
     * @return Collection
     */
    public function payloadToArray(string $payload): Collection
    {
        return collect(
            json_decode(
                base64_decode(
                    $payload
                )
            )
        );
    }

    /**
     * Realiza o decode da authorization e retorna uma collection com os campos.
     *
     * @param $header string
     *
     * @return collection
     */
    public function decoderPayload(string $header): Collection
    {
        return $this->payloadToArray(
            $this->getPayloadFromJWT(
                $this->getJWTFromBearerHeader($header)
            )
        );
    }
}
