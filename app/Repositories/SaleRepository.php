<?php

namespace App\Repositories;

use App\Exceptions\ImportException;
use App\Imports\SalesImport;
use App\Models\Sale;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class SaleRepository extends BaseRepository
{
    protected array $fieldSearchable = [
        'comprador',
        'descricao',
        'preco_unitario',
        'quantidade',
        'endereco',
        'fornecedor'
    ];

    public function model(): string
    {
        return Sale::class;
    }

    public function importSale(Request $request)
    {
        $import = new SalesImport();
        $import->import($request->file('file')->store('temp'));

        if (!$import->failures()->isEmpty()) {
            throw new ImportException($import->failures());
        }

        return $this->all();
    }
}
