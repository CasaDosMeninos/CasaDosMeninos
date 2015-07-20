@extends('layouts.master')

@section('title')
    Criar Tema
@stop

@section('subtitle')
    Digite o nome do tema a ser inserido no sistema
@stop

@section('sub-nav')
@stop

@section('content')

    <form action="{{ action('Admin\TemaController@store') }}" method="POST" class="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="{{ asset('images/icons/dark/list.png') }}" alt="" class="titleIcon" />
                    <h6>Tema</h6>
                </div>
                <div class="formRow">
                    <label>Nome:</label>
                    <div class="formRight">
                        <input type="text" value="" name="nome" />
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