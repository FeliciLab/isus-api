<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FeedbackTest extends TestCase
{
    public function testFeedbackComSucesso()
    {
        $response = $this->postJson("api/feedback", [
            'email' => 'victor.magalhaesp@gmail.com',
            'categoria' => 'Sugestão',
            'texto' => 'Realizando teste de feedback',
            'tipoDeFeedback' => 'Alerta',
        ]);
        $response->assertOk();
        $response->assertJsonFragment([
            'success' => true
        ]);
    }
}
