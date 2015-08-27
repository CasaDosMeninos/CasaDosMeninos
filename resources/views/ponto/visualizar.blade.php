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
        <div class="oneTwo">
            <div class="widget">
                <div class="title"><img src="{{ asset('images/icons/dark/globe.png') }}" alt="" class="titleIcon" />
                    <h6>Mapa</h6>
                </div>
                <div id="googleMap" style="width:100%;height:380px;"></div>
            </div>
        </div>
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
                center: new google.maps.LatLng({{ $ponto->latitude }}, {{ $ponto->longitude }}),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.SMALL
                }
            };

            map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
            marker = new google.maps.Marker({
                position: new google.maps.LatLng({{ $ponto->latitude }}, {{ $ponto->longitude }}),
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