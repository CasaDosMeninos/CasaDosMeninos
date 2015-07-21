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

        <table cellpadding="0" cellspacing="0" border="0" class="display dTables">
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
                    <td>{{ $ponto->id }};{{ $ponto->nome }}</td>
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

    <script type="text/javascript">
        oTable = $('.dTables').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "sDom": '<""l>t<"F"fp>',
            "columnDefs": [{
                "targets": 0,
                "render": function ( data, type, full, meta ) {
                    var ponto = data.split(';');
                    return '<a href="/admin/ponto/ver/'+ ponto[0] +'">'+ ponto[1] +'</a>';
                }
            }],
            "language": {
                "search": "Buscar: ",
                "lengthMenu": "Mostrar _MENU_ itens por p&aacute;gina",
                "zeroRecords": "Nenhum registro",
                "info": "Mostrando _PAGE_ p&aacute;ginas de _PAGES_",
            }
        });
    </script>
@stop