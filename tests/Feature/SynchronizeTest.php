<?php

namespace Tests\Feature;

use App\Model\Wordpress\App;
use GuzzleHttp\Client;
use Tests\TestCase;

class SynchronizeTest extends TestCase
{
    /**
     * Teste da API do Wordpress Coronavírus.
     *
     * @return void
     */
    public function test_api_coronavirus()
    {
        $client = new Client(['base_uri' => App::WORDPRESS_ENDPOINT[App::PREFIXO_CORONAVIRUS]]);
        $response = $client->request('GET');
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Teste da API do Wordpress SUS Elmo.
     *
     * @return void
     */
    public function test_api_sus_elmo()
    {
        $client = new Client(['base_uri' => App::WORDPRESS_ENDPOINT[App::PREFIXO_SUS_ELMO]]);
        $response = $client->request('GET');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
