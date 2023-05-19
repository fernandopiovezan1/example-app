@extends('base')
@section('title', __('Importação de arquivo'))
@section('body')
    <form class="px-6" action="{{'imports'}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
            <div class="custom-file text-left">
                <input type="file" name="file" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
        <div class="md:my-6">
            <button
                class="text-grey-darkest font-bold uppercase tracking-wide py-3 px-6 border-2 border-grey-light hover:border-grey rounded-lg">
                Import data
            </button>
        </div>
    </form>
@stop
