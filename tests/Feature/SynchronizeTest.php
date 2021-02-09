<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SynchronizeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSynchronize()
    {
        $response = $this->get(env('APP_URL') . '/api/synchronize');

        $response->assertStatus(200);
    }
}
