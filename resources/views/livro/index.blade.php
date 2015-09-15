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
    
    <table cellpadding="0" cellspacing="0" border="0" class="display dTable taskWidget">
        <thead>
            <tr>
	            <th>Título</th>
	            <th>Autor</th>
	            <th>Status</th>
	            <th>Dono</th>
            </tr>
        </thead>
        <tbody>
        	@foreach ($livros as $livro)
            <tr>
	            <td class="{{ ($livro->status->nome == 'Disponível')?'taskPr':'taskD' }}">/livro/ver/{{ $livro->id }};{{ $livro->titulo }}</td>
	            <td>{{ $livro->autor }}</td>
	            <td><span class="f11 {{($livro->status->nome == 'Disponível')?'green':'red'}}">{{ $livro->status->nome }}</span></td>
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

@stop