@extends('layouts.master')

@section('title')
    Criar ponto de troca
@stop

@section('subtitle')
    Preencha o formulário para criar um novo ponto de troca. O mapa atualiza conforme a mudança do endereço
@stop

@section('sub-nav')
@stop

@section('content')
    <div class="widgets">
        <div class="oneTwo">
            <div class="widget">
                <div class="title">
                    <img src="{{ asset('images/icons/dark/list.png') }}" alt="" class="titleIcon" />
                    <h6>Ponto de Troca</h6>
                </div>

                <form action="{{ action('Admin\PontoController@store') }}" method="POST" class="form validate" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" value="" id="latitude" name="latitude" />
                    <input type="hidden" value="" id="longitude" name="longitude" />
                    <fieldset>
                        <div class="formRow">
                            <label>Nome*:</label>
                            <div class="formRight">
                                <input type="text" value="" name="nome" id="nome" class="validate[required]" />
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label>Endereço*:</label>
                            <div class="formRight">
                                <input type="text" value="" name="endereco" id="endereco" class="validate[required]" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Bairro*:</label>
                            <div class="formRight">
                                <input type="text" value="" name="bairro" id="bairro" class="validate[required]" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>CEP*:</label>
                            <div class="formRight">
                                <input type="text" value="" name="cep" id="cep" class="validate[required]" />
                                <span class="formNote">Digite apenas números</span>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label>Responsável:</label>
                            <div class="formRight">
                                <input type="text" value="" name="responsavel" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Contato:</label>
                            <div class="formRight">
                                <input type="text" value="" name="contato" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Autorização:</label>
                            <div class="formRight"><input type="file" name="autorizacao" id="autorizacao"></div>
                            <div class="clear"></div>
                        </div>

                        <div class="formSubmit"><input type="submit" value="Enviar" class="blueB" /></div>

                    </fieldset>
                </form>
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
                center: new google.maps.LatLng(-23.653026, -46.747006),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.SMALL
                }
            };

            map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(-23.653026, -46.747006),
                map: map
            });
        }

        function atualizaEndereco(lat, long) {
            var loc = new google.maps.LatLng(lat, long);
            map.panTo(loc);
            marker.setPosition(loc);
            $('#latitude').val(lat);
            $('#longitude').val(long);
        }

        function loadScript() {
            var script = document.createElement("script");
            script.type = "text/javascript";
            script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyBChny4Xq0nUt2dOsEEMbM3szFSV1oViyA&sensor=false&callback=initialize";
            document.body.appendChild(script);
        }

        window.onload = loadScript;

        // Busca no Google Maps a partir do campo Endereço preenchido
        $('#endereco').blur(function() {
            $.getJSON('https://maps.googleapis.com/maps/api/geocode/json', {
                key: 'AIzaSyBChny4Xq0nUt2dOsEEMbM3szFSV1oViyA',
                address: $('#endereco').val()
            }, function(data) {
                var loc = data.results[0].geometry.location;
                atualizaEndereco(loc.lat, loc.lng);
            })
        });
    </script>
@stop