<?php

namespace App\Http\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class SaguRelatorioExport implements
    FromArray,
    WithMapping,
    ShouldAutoSize,
    WithHeadings,
    WithEvents
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function map($data): array
    {
        return [
            $data['ofertaNome'],
            $data['ofertaCargaHoraria'],
            $data['ofertaInicio'],
            $data['ofertaFim'],
            $data['ofertaAtiva'],
            $data['userNome'],
            $data['userCpf'],
            $data['componente'],
            $data['programaResidencia'],
            $data['municipioResidencia'],
            $data['chPresenca'],
            $data['percentualPresenca'],
            $data['percentualFalta'],
        ];
    }

    public function headings(): array
    {
        return [
            'Oferta Nome',
            'Oferta CH',
            'Oferta Inicio',
            'Oferta Fim',
            'Oferta Ativa',
            'Residente',
            'Residente CPF',
            'Componente',
            'Programa Residência',
            'Município Residência',
            'Presença CH',
            '% de Presença',
            '% de Falta',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:M1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
            },
        ];
    }
}
