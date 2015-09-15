@extends('layouts.master')

@section('title')
    Visualizar ponto de troca
@stop

@section('subtitle')
    {{ $ponto->nome }}<br/>
    {{ $ponto->endereco }} - {{ $ponto->bairro }} - {{ $ponto->cep }}
@stop

@section('sub-nav')
    <div class="statsRow">
        <div class="wrapper">
            <div class="controlB">
                <ul>
                    <li>
                        <a href="{{ action('PontoController@livros', ['id' => $ponto->id]) }}" title="">
                            <img src="{{ asset('images/icons/control/32/search.png') }}" alt="" />
                            <span>Ver livros</span>
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
    <div class="widgets">
        <div class="oneTwo">
            <div class="widget">
                <div class="title">
                    <img src="{{ asset('images/icons/dark/list.png') }}" alt="" class="titleIcon" />
                    <h6>Livro</h6>
                </div>

                <div class="body">
                    <dl>
                        <dt class="pt20">Nome</dt>
                        <dd>{{ $ponto->nome }}</dd>

                        <dt class="pt20">Endereço</dt>
                        <dd>{{ $ponto->endereco }}</dd>

                        <dt class="pt20">Bairro</dt>
                        <dd>{{ $ponto->bairro }}</dd>

                        <dt class="pt20">CEP</dt>
                        <dd>{{ $ponto->cep }}</dd>

                        <dt class="pt20">Responsável</dt>
                        @if($ponto->responsavel)
                            <dd>{{ $ponto->responsavel }}</dd>
                        @else
                            <dd>Não possui</dd>
                        @endif

                        <dt class="pt20">Contato</dt>
                        @if($ponto->contato)
                            <dd>{{ $ponto->contato }}</dd>
                        @else
                            <dd>Não possui</dd>
                        @endif

                        <dt class="pt20">Autorização</dt>
                        @if($ponto->autorizacao)
                            <dd><a href="{{ asset('autorizacao/' . $ponto->autorizacao) }}" target="_blank">Download</a></dd>
                        @else
                            <dd>Não possui</dd>
                        @endif
                    </dl>
                </div>
            </div>
        </div>

        @include('partials.mapa', ['lat' => $ponto->latitude, 'lng' => $ponto->longitude])
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