<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Model\AlertaDeEpi\AlertaDeEpi;
use Illuminate\Http\Request;
class AlertaDeEpiTest extends TestCase
{
    /**
     * Testa se a versão e plataforma está indo corretamente
     *
     * @return void
     */
    public function testaVersaoePlataformaAndroid()
    {
        $request = $this->getMockBuilder(Illuminate\Http\Request::class)
        ->disableOriginalConstructor()
        ->disableOriginalClone()
        ->getMock();

        $request
        ->method('all')
        ->willReturn([
            'descricao' => 'descrição de teste',
            'unidadeDeSaude' => 'abc',
            'email' => 'teste@teste.com',
            'versaoAplicativo' => '3.10.0',
            'plataforma' => 'android'
        ]);

        $alertaDeEpi = new AlertaDeEpi($request);
        $this->assertEquals('3.10.0', $alertaDeEpi->versaoAplicativo);
        $this->assertEquals('android', $alertaDeEpi->plataforma);
    }

     /**
     * Testa se a versão e plataforma está indo corretamente
     *
     * @return void
     */
    public function testVersaoEPlataformaIOS()
    {
        $request = $this->createMock(Request::class);
        echo $request;
        $request->method('all')->willReturn([
            'descricao' => 'descrição de teste',
            'unidadeDeSaude' => 'abc',
            'email' => 'teste@teste.com',
            'versaoAplicativo' => '3.10.0',
            'plataforma' => 'ios'
        ]);

        $alertaDeEpi = new AlertaDeEpi($request);
        $this->assertEquals('3.10.0', $alertaDeEpi->versaoAplicativo);
        $this->assertEquals('ios', $alertaDeEpi->plataforma);
    }
}
