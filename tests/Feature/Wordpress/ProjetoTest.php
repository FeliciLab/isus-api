<?php

namespace Tests\Feature\Wordpress;

use App\Model\Wordpress\Projeto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjetoTest extends TestCase
{
    public function testRetornaProjetoSemParametro()
    {
        $response = $this->json('GET', "api/projeto/");
        $response->assertNotFound();
    }

    public function testProjetoComParametroExistente()
    {
        $projetos = Projeto::all();
        $projeto = $projetos->first();

        $response = $this->json('GET', "api/projeto/{$projeto->id}");
        $response->assertJsonStructure([
            'id',
            'slug',
            'post_date',
            'post_title',
            'post_content',
            'image',
            'anexos',
        ]);
        $response->assertOk();
    }
}
