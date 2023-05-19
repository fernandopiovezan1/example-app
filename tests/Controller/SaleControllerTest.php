<?php

namespace Tests\Controller;

use App\Imports\SalesImport;
use App\Models\Sale;
use App\Repositories\SaleRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SaleControllerTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions, DatabaseMigrations;

    private UploadedFile $input;
    private UploadedFile $inputErr;
    public function setUp() : void
    {
        parent::setUp();
        $this->input = $this->createFile(false);
        $this->inputErr = $this->createFile(true);
    }

    /**
     * @test create
     */
    public function test_index_sale()
    {
        $response = $this->call('GET', 'imports');

        $this->assertTrue($response->isOk());

        // Even though the two lines above may be enough,
        // you could also check for something like this:

        View::shouldReceive('make')->with('imports');
    }

    /**
     * @test store
     */
    public function test_store_sale()
    {
        Storage::persistentFake('public');
        $response = $this->call('POST','imports', [], [], [
            'file' => $this->input
        ]);
        $this->assertTrue($response->assertViewIs('imports.show')->isOk());
    }

    public function test_error_store_sale()
    {
        Storage::persistentFake('public');
        $response = $this->call('POST','imports', [], [], [
            'file' => $this->inputErr
        ]);
        $this->assertTrue($response->assertViewIs('errors.import')->isClientError());
    }

    /**
     * @param bool $err
     * @return UploadedFile
     */
    public function createFile(bool $err): UploadedFile
    {
        $fileName = $err ? 'text-err.txt' : 'test.txt';
        $filePath = storage_path('app/' . $fileName);
        $error = $err ? 'Descriçao' : 'Descrição';

        $dataHeader = [['Comprador',$error,'Preço Unitário','Quantidade','Endereço','Fornecedor']];

        $dataRow = [
            ['João Silva','R$10 off R$20 of food','10.0','2','987 Fake','St Bobs Pizza'],
            ['Amy Pond','R$30 of awesome for R$10','10.0','5','456 Unreal Rd','Toms Awesome Shop'],
        ];

        $handle = fopen($filePath, 'w');

        collect($dataHeader)->each(fn ($row) => fputcsv($handle, $row, "\t"));
        collect($dataRow)->each(fn ($row) => fputcsv($handle, $row, "\t"));
        fclose($handle);

        return new UploadedFile($filePath, $err ? 'file-err.txt' : 'file.txt');
    }
}

