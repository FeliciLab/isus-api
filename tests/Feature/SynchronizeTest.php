<?php

namespace Tests\Feature;

use GuzzleHttp\Client;
use Tests\TestCase;
use App\Model\Wordpress\App;

class SynchronizeTest extends TestCase
{
    /**
     * Teste da API do Wordpress Coronavírus.
     *
     * @return void
     */
    public function test_api_coronavirus()
    {
       
        // dd(App::WORDPRESS_ENDPOINT[App::PREFIXO_CORONAVIRUS]);
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
       
        // dd(App::WORDPRESS_ENDPOINT[App::PREFIXO_CORONAVIRUS]);
        $client = new Client(['base_uri' => App::WORDPRESS_ENDPOINT[App::PREFIXO_SUS_ELMO]]);
        $response = $client->request('GET');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
