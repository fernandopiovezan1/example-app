@extends('base')
@section('title', __('Valores importados'))
@section('body')
    <table class="center">
        <thead>
        <tr>
            <th> Comprador</th>
            <th> Descrição</th>
            <th> Preço Unitário</th>
            <th> Quantidade</th>
            <th> Endereço</th>
            <th> Fornecedor</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sales as $sale)
            <tr>
                <td> {{$sale['comprador']}} </td>
                <td> {{$sale['descricao']}} </td>
                <td> {{$sale['preco_unitario']}} </td>
                <td> {{$sale['quantidade']}} </td>
                <td> {{$sale['endereco']}} </td>
                <td> {{$sale['fornecedor']}} </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th style="text-align: end!important;" colspan="6">Total de Vendas {{$sales->sum('preco_unitario')}}</th>
        </tr>
        </tfoot>
    </table>
    <div class="md:my-6">
        <a href="{{ url('imports') }}">
            <button
                class="bg-transparent text-grey-darkest font-bold uppercase tracking-wide py-3 px-6 border-2 border-grey-light hover:border-grey rounded-lg">
                {{ __('Go Home') }}
            </button>
        </a>
    </div>
@stop
