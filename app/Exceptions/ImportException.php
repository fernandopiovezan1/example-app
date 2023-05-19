<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Validators\Failure;

class ImportException extends Exception
{

    protected Collection|Failure $data;

    public function __construct(Collection|Failure $data)
    {
        parent::__construct();
        $this->data = $data;
    }
    
    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
        Log::debug('Import Error');
    }

    public function render($request): Response
    {
        $failures = [];
        foreach ($this->data as $failure) {
            $failures[] = [
                'row' => $failure->row(),
                'error' => $failure->errors()[0]
            ];
        }
        
        return response()->view('errors.import', ['failures' => $failures], 400);
    }
    
    
}
