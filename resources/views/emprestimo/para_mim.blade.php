@extends('layouts.master')

@section('title')
    Solicitações para mim
@stop

@section('subtitle')
    Aceite ou recuse um pedido de empréstimo de livro para você
@stop

@section('sub-nav')
@stop

@section('content')
    <div class="widget">
        <div class="title"><img src="{{ asset('images/icons/dark/books.png') }}" alt="" class="titleIcon" />
            <h6>Solicitações</h6>
        </div>

        <table cellpadding="0" cellspacing="0" border="0" class="display dTables">
            <thead>
            <tr>
                <th>Título</th>
                <th>Data do pedido</th>
                <th>Data da devolução</th>
                <th>Solicitante</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($emprestimos as $emprestimo)
                <tr>
                    <td>{{ $emprestimo->id }};{{ $emprestimo->livro->titulo }}</td>
                    <td>{{ $emprestimo->created_at->format('d/m/Y') }}</td>
                    <td>{{ $emprestimo->data->format('d/m/Y') }}</td>
                    <td>{{ $emprestimo->solicitante->name }}</td>
                    <td>{{ $emprestimo->status->nome }}</td>
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
                    var emprestimo = data.split(';');
                    return '<a href="/emprestimo/solicitacao/ver/'+ emprestimo[0] +'">'+ emprestimo[1] +'</a>';
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