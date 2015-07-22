@extends('layouts.master')

@section('title')
    Pedir empréstimo
@stop

@section('subtitle')
    Selecione a data que pretende devolver o livro e, caso queira, especifique as condições do empréstimo.
@stop

@section('sub-nav')
@stop

@section('content')
    <form action="{{ action('EmprestimoController@store') }}" method="POST" class="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $livro->id }}">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="{{ asset('images/icons/dark/list.png') }}" alt="" class="titleIcon" />
                    <h6>Empréstimo</h6>
                </div>
                <div class="formRow">
                    <label>Data de devolução:</label>
                    <div class="formRight">
                        <div class="datepicker"></div>
                        <input type="hidden" class="hidDatePicker" name="data">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Observações:</label>
                    <div class="formRight">
                        <textarea name="obs" rows="4"></textarea>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formSubmit"><input type="submit" value="Enviar" class="blueB" /></div>
            </div>
        </fieldset>
    </form>
@stop

@section('js')
    @if (old('cadastro') != null)
        <script type="text/javascript">
            // Mensagem de erro se existir algum
            $.jGrowl("{{ old('cadastro') }}");
        </script>
    @endif
@stop