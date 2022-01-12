<?php

namespace Tests\Feature;

use Tests\TestCase;

class FeedbackTest extends TestCase
{
    public function testFeedbackComSucesso()
    {
        $response = $this->postJson('api/feedback', [
            'email' => 'victor.magalhaesp@gmail.com',
            'categoria' => 'Sugestão',
            'texto' => 'Realizando teste de feedback',
            'tipoDeFeedback' => 'Alerta',
            'versaoAplicativo' => 1,
            'plataforma' => 'android',
        ]);
        $response->assertOk();
        $response->assertJsonFragment([
            'success' => true,
        ]);
    }
}
