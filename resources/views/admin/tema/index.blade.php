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

        <table cellpadding="0" cellspacing="0" border="0" class="display dTables">
            <thead>
            <tr>
                <th>Nome</th>
                <th>&Uacute;ltima modifica&ccedil;&atilde;o</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($temas as $tema)
                <tr>
                    <td>{{ $tema->id }};{{ $tema->nome }}</td>
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

    <script type="text/javascript">
        oTable = $('.dTables').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "sDom": '<""l>t<"F"fp>',
            "columnDefs": [{
                "targets": 0,
                "render": function ( data, type, full, meta ) {
                    var tema = data.split(';');
                    return '<a href="/admin/tema/ver/'+ tema[0] +'">'+ tema[1] +'</a>';
                }
            }, {
                "targets": 1,
                "width": "15%"
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