<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Sale extends Model
{
    use SoftDeletes, HasFactory;
    
    public $table = 'sales';

    public $fillable = [
        'comprador',
        'descricao',
        'preco_unitario',
        'quantidade',
        'endereco',
        'fornecedor'
    ];

    protected $casts = [
        'comprador' => 'string',
        'descricao' => 'string',
        'preco_unitario' => 'decimal:3',
        'quantidade' => 'decimal:5',
        'endereco' => 'string',
        'fornecedor' => 'string'
    ];

    public static array $rules = [
        'comprador' => 'required|string|max:100',
        'descricao' => 'required|string|max:150',
        'preco_unitario' => 'required|numeric',
        'quantidade' => 'required|numeric',
        'endereco' => 'required|string|max:150',
        'fornecedor' => 'required|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];
}
