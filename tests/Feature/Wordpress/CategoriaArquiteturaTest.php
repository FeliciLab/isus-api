<?php

namespace Tests\Feature\Wordpress;

use App\Model\Wordpress\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriaArquiteturaTest extends TestCase
{
    public function testListaCategoriaCadastrada()
    {
        $response = $this->json('GET', 'api/categoriasArquitetura');
        $response->assertJsonCount(4);
        $response->assertJsonFragment([
            'name' => 'Cursos on-line'
        ]);
        $response->assertOk();
    }
}
