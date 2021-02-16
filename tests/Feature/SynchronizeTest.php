<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Service\WppSyncService;

class SynchronizeTest extends TestCase
{
    use RefreshDatabase;
    
    function setUp(): void {
        parent::setUp();
        $this->seed(WppSyncService::class);
    }

    /**
     * A basic feature test example.
     * @return void
     */
    public function testSalvarCategoria()
    {
        $this->assertDatabaseHas('', [
            'email' => 'sally@example.com',
        ]);
    }

    /**
     * A basic feature test example.
     * @return void
     */
    public function testSalvarProjeto()
    {
        $this->assertDatabaseHas('', [
            'email' => 'sally@example.com',
        ]);
    }

    /**
     * A basic feature test example.
     * @return void
     */
    public function testJuncaoCategoriaProjeto()
    {
        $this->assertDatabaseHas('', [
            'email' => 'sally@example.com',
        ]);
    }
}
