@extends('base')
@section('title', __('Erro na importação'))
@section('body')
    <table>
        <thead>
        <tr>
            <th> Linha</th>
            <th> Erro</th>
        </tr>
        </thead>
        <tbody>
        @foreach($failures as $failure)
            <tr>
                <td> {{$failure['row']}} </td>
                <td> {{$failure['error']}} </td>
            </tr>
        @endforeach
        </tbody>
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


