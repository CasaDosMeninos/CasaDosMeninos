@extends('layouts.master')

@section('title')
    Temas
@stop

@section('subtitle')
    Todos os temas de livro cadastrados no sistema
@stop

@section('sub-nav')
    <div class="statsRow">
        <div class="wrapper">
            <div class="controlB">
                <ul>
                    <li>
                        <a href="{{ action('Admin\TemaController@create') }}" title="">
                            <img src="{{ asset('images/icons/control/32/plus.png') }}" alt="" />
                            <span>Criar tema</span>
                        </a>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="line"></div>
@stop

@section('content')
    <div class="widget">
        <div class="title"><img src="{{ asset('images/icons/dark/list.png') }}" alt="" class="titleIcon" />
            <h6>Temas</h6>
        </div>

        <table cellpadding="0" cellspacing="0" border="0" class="display dTable">
            <thead>
            <tr>
                <th>Nome</th>
                <th>&Uacute;ltima modifica&ccedil;&atilde;o</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($temas as $tema)
                <tr>
                    <td>/admin/tema/ver/{{ $tema->id }};{{ $tema->nome }}</td>
                    <td>{{ Date::parse($tema->updated_at)->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('js')
    @if (old('cadastro') != null)
        <script type="text/javascript">
            // Mensagem de erro se existir algum
            $.jGrowl("{{ old('cadastro') }}");
        </script>
    @endif


@stop