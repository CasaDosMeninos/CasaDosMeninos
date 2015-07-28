@extends('layouts.master')

@section('title')
    Visualizar Tema
@stop

@section('subtitle')
    {{ $tema->nome }}
@stop

@section('sub-nav')
    <div class="statsRow">
        <div class="wrapper">
            <div class="controlB">
                <ul>
                    <li>
                        <a id="deletar" href="#" title="">
                            <img src="{{ asset('images/icons/control/32/busy.png') }}" alt="" />
                            <span>Deletar</span>
                        </a>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="line"></div>

    <div id="dialog-confirm" class="hide" title="Apagar todos os livros deste tema?">
        <p>
            <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
            Todos os livros que pertencem a este tema serão deletados. Você tem certeza?
        </p>
    </div>
@stop

@section('content')

        <form action="{{ action('Admin\TemaController@update') }}" method="POST" class="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $tema->id }}">
            <fieldset>
                <div class="widget">
                    <div class="title">
                        <img src="{{ asset('images/icons/dark/list.png') }}" alt="" class="titleIcon" />
                        <h6>Tema</h6>
                    </div>
                    <div class="formRow">
                        <label>Nome:</label>
                        <div class="formRight">
                            <input type="text" value="{{ $tema->nome }}" name="nome" />
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <label>&Uacute;ltima modifica&ccedil;&atilde;o:</label>
                        <div class="formRight">
                            {{ Date::parse($tema->updated_at)->format('d/m/Y H:i') }}
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <label>Criado em:</label>
                        <div class="formRight">
                            {{ Date::parse($tema->created_at)->format('d/m/Y H:i') }}
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

    <script type="text/javascript">
        $('a#deletar').click(function(){
            $('#dialog-confirm').dialog({
                height:140,
                modal: true,
                buttons: {
                    "Apagar todos os livros": function () {
                        window.location.href = '{{ action('Admin\TemaController@destroy', ['id' => $tema->id]) }}';
                    },
                    Cancel: function () {
                        $(this).dialog("close");
                    }
                }
            });
        });
    </script>
@stop