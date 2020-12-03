<?php

declare(strict_mode=1);

namespace App\Domains\QualiQuiz\Utils;

use Illuminate\Support\Collection;

class JWTDecoder
{
    public function getJWTFromBearerHeader(string $header): string
    {
        return explode(
            ' ',
            $header
        )[1];
    }

    public function getPayloadFromJWT(string $jwt): string
    {
        return explode(
            '.',
            $jwt
        )[1];
    }

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

    public function decoderPayload(string $header): Collection
    {
        return $this->payloadToArray(
            $this->getPayloadFromJWT(
                $this->getJWTFromBearerHeader($header)
            )
        );
    }
}
