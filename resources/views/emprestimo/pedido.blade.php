@extends('layouts.master')

@section('title')
    Visualizar Empréstimo
@stop

@section('subtitle')
    {{ $livro->titulo }}
@stop

@section('sub-nav')
    <div class="statsRow">
        <div class="wrapper">
            <div class="controlB">
                <ul>

                    <li>
                        <a href="{{ action('LivroController@show', ['livro' => $livro->id]) }}" title="">
                            <img src="{{ asset('images/icons/control/32/search.png') }}" alt="" />
                            <span>Ver livro</span>
                        </a>
                    </li>

                    @if($modo == 'pedido')
                        <li>
                            <a href="{{ action('EmprestimoController@destroy', ['emprestimo' => $emprestimo->id]) }}" title="">
                                <img src="{{ asset('images/icons/control/32/busy.png') }}" alt="" />
                                <span>Cancelar pedido</span>
                            </a>
                        </li>
                    @elseif($modo == 'solicitacao')
                        <li>
                            <a href="{{ action('EmprestimoController@update', ['emprestimo' => $emprestimo->id, 'acao' => 'aceitar']) }}" title="">
                                <img src="{{ asset('images/icons/control/32/check.png') }}" alt="" />
                                <span>Aceitar</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ action('EmprestimoController@update', ['emprestimo' => $emprestimo->id, 'acao' => 'recusar']) }}" title="">
                                <img src="{{ asset('images/icons/control/32/busy.png') }}" alt="" />
                                <span>Recusar</span>
                            </a>
                        </li>
                    @endif
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
                    <h6>Empréstimo</h6>
                </div>

                <div class="body">
                    <dl>
                        <dt class="pt20">Imagem</dt>
                        <dd>
                            @if($livro->imagem == FALSE)
                                <img src="{{ asset('images/sem_imagem.gif') }}" width="100" height="100">
                            @else
                                <img src="{{ asset("livros/{$livro->id}.jpg") }}" width="100" height="100">
                            @endif
                        </dd>

                        <dt class="pt20">Título</dt>
                        <dd>{{ $livro->titulo }}</dd>

                        <dt class="pt20">Status</dt>
                        <dd>{{ $livro->status->nome }}</dd>

                        <dt class="pt20">Data do pedido</dt>
                        <dd>{{ $emprestimo->created_at->format('d/m/Y') }}</dd>

                        <dt class="pt20">Data da devolução</dt>
                        <dd>{{ $emprestimo->data->format('d/m/Y') }}</dd>

                        @if($modo == 'pedido')
                            <dt class="pt20">Dono</dt>
                            <dd>{{ $emprestimo->dono->name }}</dd>
                        @elseif($modo == 'solicitacao')
                            <dt class="pt20">Solicitante</dt>
                            <dd>{{ $emprestimo->solicitante->name }}</dd>
                        @endif

                        <dt class="pt20">Observações</dt>
                        <dd>{{ $emprestimo->obs }}</dd>

                        <dt class="pt20">Ponto de troca</dt>
                        <dd>{{ $livro->ponto->nome }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="oneTwo">
            <div class="widget">
                <div class="title"><img src="{{ asset('images/icons/dark/globe.png') }}" alt="" class="titleIcon" />
                    <h6>Mapa</h6>
                </div>
                <div id="googleMap" style="width:100%;height:380px;"></div>
            </div>
        </div>
    </div>

    <div id="dialog-message">
        @include('emprestimo.dialog')
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
        /* Google MAPS
         ================================================== */
        var map, marker, lat, long;
        function initialize() {
            var mapOptions = {
                zoom: 14,
                center: new google.maps.LatLng({{ $livro->ponto->latitude }}, {{ $livro->ponto->longitude }}),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.SMALL
                }
            };

            map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
            marker = new google.maps.Marker({
                position: new google.maps.LatLng({{ $livro->ponto->latitude }}, {{ $livro->ponto->longitude }}),
                map: map
            });
        }

        function loadScript() {
            var script = document.createElement("script");
            script.type = "text/javascript";
            script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyBChny4Xq0nUt2dOsEEMbM3szFSV1oViyA&sensor=false&callback=initialize";
            document.body.appendChild(script);
        }

        window.onload = loadScript;
    </script>
@stop