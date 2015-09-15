@extends('layouts.master')

@section('title')
    Perfil
@stop

@section('subtitle')
    Aqui você pode ver seus dados cadastrados na Casa dos Meninos. É importante que você
    mantenha seus dados atualizados para o melhor funcionamento do sistema.
@stop

@section('sub-nav')
@stop

@section('content')
    <div class="nNote nWarning hideit hide">
        <p>
            Não foi possível encontrar o endereço cadastrado. Por favor atualize seu endereço em
            <a target="_blank" href="http://login.casadosmeninos.org.br">Login Único</a> Casa dos Meninos
        </p>
    </div>
    <div class="widgets">
        <div class="oneTwo">
            <div class="widget">
                <div class="title">
                    <img src="{{ asset('images/icons/dark/maleContour.png') }}" alt="" class="titleIcon" />
                    <h6>Meu perfil</h6>
                </div>
                <div class="newOrder">
                    <div class="userRow">
                        <a href="#" title=""><img src="{{ asset('images/user.png') }}" alt="" class="floatL" /></a>
                        <ul class="leftList">
                            <li><a href="#" title=""><strong>{{ $user->sn[0] }}</strong></a></li>
                            <li>Possui
                                <a href="{{ url("perfil/{$model->id}/livros") }}">
                                    <strong>{{ count($model->livros) }}</strong>
                                </a> livros
                            </li>
                        </ul>

                        <div class="clear"></div>
                    </div>

                    <div class="cLine"></div>

                    <div class="orderRow">
                        <ul class="leftList">
                            <li>Email:</li>
                            <li>Endereço:</li>
                            <li>CEP:</li>
                            <li>Telefone 1:</li>
                            <li>Telefone 2:</li>
                            <li>Data de Nascimento:</li>
                            @if ($user->categoria[0] != 'nenhuma')
                                <li>Categoria:</li>
                                <li>Escola:</li>
                                <li>Série:</li>
                            @endif
                        </ul>
                        <ul class="rightList">
                            <li><strong>{{ $user->mail[0] }}</strong></li>
                            <li><strong>{{ $user->homepostaladdress[0] }}</strong></li>
                            <li><strong>{{ $user->postalcode[0] }}</strong></li>
                            <li><strong>{{ $user->mobile[0] }}</strong></li>
                            <li><strong>{{ $user->homephone[0] }}</strong></li>
                            <li><strong>{{ $user->birthdate[0] }}</strong></li>
                            @if ($user->categoria[0] != 'nenhuma')
                                <li><strong>{{ $user->categoria[0] }}</strong></li>
                                <li><strong>{{ $user->escola[0] }}</strong></li>
                                <li><strong>{{ $user->serie[0] }}</strong></li>
                            @endif
                        </ul>
                        <div class="clear"></div>
                    </div>

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
        <div class="clear"></div>
    </div>

    @include('partials.historico')

@stop

@section('js')
    <script type="text/javascript">
        /* Google MAPS
         ================================================== */

        function initialize() {
            $.getJSON('https://maps.googleapis.com/maps/api/geocode/json', params, function(data) {
                if(data.status == 'ZERO_RESULTS') {
                    $('.nNote').show();
                }
                var lat = data.results[0].geometry.location.lat;
                var lng = data.results[0].geometry.location.lng;
                var mapa = new google.maps.LatLng(lat, lng)

                var mapOptions = {
                    zoom: 14,
                    center: mapa,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    zoomControlOptions: {
                        style: google.maps.ZoomControlStyle.SMALL
                    }
                };

                map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
                marker = new google.maps.Marker({
                    position: mapa,
                    map: map
                });
            });
        }

        function loadScript() {
            var script = document.createElement("script");
            script.type = "text/javascript";
            script.src = "http://maps.googleapis.com/maps/api/js?key=&sensor=false&callback=initialize";
            document.body.appendChild(script);
        }

        window.onload = loadScript;

        var params = {
            address: '{{ $user->homepostaladdress[0] }}',
            key: 'AIzaSyBChny4Xq0nUt2dOsEEMbM3szFSV1oViyA'
        }

    </script>
@stop