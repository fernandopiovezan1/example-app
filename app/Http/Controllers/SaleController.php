<?php

namespace App\Http\Controllers;

use App\Repositories\SaleRepository;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /** @var SaleRepository $SaleRepository */
    private SaleRepository $SaleRepository;

    public function __construct(SaleRepository $saleRepo)
    {
        $this->SaleRepository = $saleRepo;
    }

    /**
     * Display a listing of the Sale.
     */
    public function index(Request $request)
    {
        return view('imports.file-import');
    }

    /**
     * Store a newly created Sale in storage.
     */
    public function store(Request $request)
    {
        $sales = $this->SaleRepository->importSale($request);

        return view('imports.show', compact('sales'));
    }
}
