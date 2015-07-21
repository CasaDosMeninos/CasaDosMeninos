@extends('layouts.master')

@section('title')
	Consultar livros
@stop

@section('subtitle')
	Você pode consultar todos os livros aqui
@stop

@section('sub-nav')
@stop

@section('content')
<div class="widget">
    <div class="title"><img src="{{ asset('images/icons/dark/books.png') }}" alt="" class="titleIcon" />
    	<h6>Livros disponíveis</h6>
    </div>                          
    
    <table cellpadding="0" cellspacing="0" border="0" class="display dTables">
        <thead>
            <tr>
	            <th>Título</th>
	            <th>Autor</th>
	            <th>Editora</th>
	            <th>Dono</th>
            </tr>
        </thead>
        <tbody>
        	@foreach ($livros as $livro)
            <tr>
	            <td>{{ $livro->id }};{{ $livro->titulo }}</td>
	            <td>{{ $livro->autor }}</td>
	            <td>{{ $livro->editora }}</td>
	            <td>{{ $livro->dono->name }}</td>
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
                    var livro = data.split(';');
                    return '<a href="/livro/ver/'+ livro[0] +'">'+ livro[1] +'</a>';
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