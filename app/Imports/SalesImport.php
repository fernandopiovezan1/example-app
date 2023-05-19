<?php

namespace App\Imports;

use App\Models\Sale;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class SalesImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Sale::updateOrCreate(
                [
                    'comprador' => $row['Comprador']
                ],
                [
                    'comprador' => $row['Comprador'],
                    'descricao' => $row['Descrição'],
                    'preco_unitario' => $row['Preço Unitário'],
                    'quantidade' => $row['Quantidade'],
                    'endereco' => $row['Endereço'],
                    'fornecedor' => $row['Fornecedor'],
                ]
            );
        }
    }

    public function rules(): array
    {
        return [
            'Comprador' => [
                'required',
                'string',
            ],
            'Descrição' => [
                'required',
                'string',
            ],
            'Preço Unitário' => [
                'required',
                'numeric',
            ],
            'Quantidade' => [
                'required',
                'numeric',
            ],
            'Endereço' => [
                'required',
                'string',
            ],
            'Fornecedor' => [
                'required',
                'string',
            ]
        ];
    }
}
