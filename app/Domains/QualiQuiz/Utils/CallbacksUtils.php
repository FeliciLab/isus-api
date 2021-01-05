<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Utils;

/**
 * Coleção de callbacks.
 *
 * @category Service
 *
 * @author  Chicão Thiago <fthiagogv@gmail.com>
 * @license GPL-3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link https://github.com/EscolaDeSaudePublica/isus-api/issues/137
 */
class CallbacksUtils
{
    /**
     * Função para uso no stream para download do relatório.
     *
     * @param mixed $dados   Lista de dados
     * @param mixed $headers Lista com o campo => cabeçalho
     *
     * @return callable
     */
    public function callbackCsvStream($dados, $headers): callable
    {
        return function () use ($dados, $headers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, array_values($headers));
            foreach ($dados as $linha) {
                $csv = [];
                foreach (array_keys($headers) as $campo) {
                    $csv[] = $linha->$campo;
                }
                fputcsv($file, $csv);
            }

            fclose($file);
        };
    }
}
