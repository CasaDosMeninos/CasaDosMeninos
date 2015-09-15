@extends('layouts.master')

@section('title')
    Pedidos
@stop

@section('subtitle')
    @if($modo == 'solicitacao')
        Aceite ou recuse um pedido de empréstimo de livro para você
    @elseif($modo == 'pedido')
        Aqui você pode consultar todos os pedidos de livro que você já fez e não estão concluidos
    @endif
@stop

@section('sub-nav')
@stop

@section('content')
    @include('partials.historico')
@stop

@section('js')
    @if (old('cadastro') != null)
        <script type="text/javascript">
            $.jGrowl("{{ old('cadastro') }}");
        </script>
    @endif
@stop