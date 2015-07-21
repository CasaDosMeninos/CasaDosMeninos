@extends('layouts.master')

@section('title')
    Visualizar Livro
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
                        <a href="{{ action('EmprestimoController@store', ['livro' => $livro->id]) }}" title="">
                            <img src="{{ asset('images/icons/control/32/issue.png') }}" alt="" />
                            <span>Pedir Emprestado</span>
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
                        <dt class="pt20">Imagem</dt>
                        <dd>
                            @if($livro->imagem == FALSE)
                                <img src="{{ asset('images/sem_imagem.gif') }}" width="100" height="100">
                            @endif
                        </dd>

                        <dt class="pt20">ISBN</dt>
                        <dd>{{ $livro->isbn }}</dd>
    
                        <dt class="pt20">Título</dt>
                        <dd>{{ $livro->titulo }}</dd>

                        <dt class="pt20">Edição</dt>
                        <dd>{{ $livro->edicao }}</dd>

                        <dt class="pt20">Ano</dt>
                        <dd>{{ $livro->ano }}</dd>

                        <dt class="pt20">Páginas</dt>
                        <dd>{{ $livro->paginas }}</dd>

                        <dt class="pt20">Editora</dt>
                        <dd>{{ $livro->editora }}</dd>

                        <dt class="pt20">Autor</dt>
                        <dd>{{ $livro->autor }}</dd>

                        <dt class="pt20">Tema</dt>
                        <dd>{{ $livro->tema->nome }}</dd>

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