@extends('layouts.master')

@section('title')
    Consultar pontos de troca
@stop

@section('subtitle')
    Você pode consultar todos os pontos de troca aqui
@stop

@section('sub-nav')
    <div class="statsRow">
        <div class="wrapper">
            <div class="controlB">
                <ul>
                    <li>
                        <a href="{{ action('Admin\PontoController@create') }}" title="">
                            <img src="{{ asset('images/icons/control/32/plus.png') }}" alt="" />
                            <span>Criar ponto</span>
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
        <div class="title"><img src="{{ asset('images/icons/dark/books.png') }}" alt="" class="titleIcon" />
            <h6>Pontos de troca</h6>
        </div>

        <table cellpadding="0" cellspacing="0" border="0" class="display dTable">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Livros alocados</th>
                <th>Endereço</th>
                <th>Bairro</th>
                <th>CEP</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($pontos as $ponto)
                <tr>
                    <td>/admin/ponto/ver/{{ $ponto->id }};{{ $ponto->nome }}</td>
                    <td>{{ count($ponto->livros) }}</td>
                    <td>{{ $ponto->endereco }}</td>
                    <td>{{ $ponto->bairro }}</td>
                    <td>{{ $ponto->cep }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('js')
    @if (old('cadastro') != null)
        <script type="text/javascript">
            $.jGrowl("{{ old('cadastro') }}");
        </script>
    @endif
@stop