@extends('layouts.master')

@section('title')
    Visualizar ponto de troca
@stop

@section('subtitle')
    {{ $ponto->nome }}
@stop

@section('sub-nav')
    <div class="statsRow">
        <div class="wrapper">
            <div class="controlB">
                <ul>
                    <li>
                        <a href="{{ action('Admin\PontoController@livros', ['id' => $ponto->id]) }}" title="">
                            <img src="{{ asset('images/icons/control/32/document-library.png') }}" alt="" />
                            <span>Livros</span>
                        </a>
                    </li>

                    <li>
                        <a id="deletar" href="#" title="">
                            <img src="{{ asset('images/icons/control/32/busy.png') }}" alt="" />
                            <span>Deletar</span>
                        </a>
                    </li>

                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="line"></div>

    <div id="dialog-confirm" class="hide" title="Apagar todos os livros deste ponto de troca?">
        <p>
            <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
            Todos os livros que pertencem a este ponto de troca serão deletados. Você tem certeza?
        </p>
    </div>
@stop

@section('content')

    <div class="widgets">
        <div class="oneTwo">
            <div class="widget">
                <div class="title">
                    <img src="{{ asset('images/icons/dark/list.png') }}" alt="" class="titleIcon" />
                    <h6>Ponto de Troca</h6>
                </div>

                <form action="{{ action('Admin\PontoController@update') }}" method="POST" class="form validate" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" value="{{ $ponto->id }}" name="id" />
                    <input type="hidden" value="{{ $ponto->latitude }}" id="latitude" name="latitude" />
                    <input type="hidden" value="{{ $ponto->longitude }}" id="longitude" name="longitude" />
                    <fieldset>
                        <div class="formRow">
                            <label>Nome*:</label>
                            <div class="formRight">
                                <input type="text" value="{{ $ponto->nome }}" name="nome" id="nome" class="validate[required]" />
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label>CEP*:</label>
                            <div class="formRight">
                                <input type="text" value="{{ $ponto->cep }}" name="cep" id="cep" class="validate[required]" />
                                <span class="formNote">Digite apenas números</span>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Endereço*:</label>
                            <div class="formRight">
                                <input type="text" value="{{ $ponto->endereco }}" name="endereco" id="endereco" class="validate[required]" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label for="numero">Número*:</label>
                            <div class="formRight">
                                <input type="text" value="" name="numero" id="numero" class="validate[required]" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Bairro*:</label>
                            <div class="formRight">
                                <input type="text" value="{{ $ponto->bairro }}" name="bairro" id="bairro" class="validate[required]" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Responsável:</label>
                            <div class="formRight">
                                <input type="text" value="{{ $ponto->responsavel }}" name="responsavel" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Contato:</label>
                            <div class="formRight">
                                <input type="text" value="{{ $ponto->contato }}" name="contato" />
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
        $('#cep').blur(function() {
            $.ajax({
                url: 'http://correiosapi.apphb.com/cep/' + $(this).val(),
                dataType: 'jsonp',
                crossDomain: true,
                contentType: "application/json"
            }).then(function(data) {
//                $('#endereco, #bairro').attr('disabled', false);
                $('#endereco').val(data.tipoDeLogradouro + ' ' + data.logradouro);
                $('#bairro').val(data.bairro);
            })
        });
    </script>

    <script type="text/javascript">
        $('a#deletar').click(function(){
            $('#dialog-confirm').dialog({
                height:140,
                modal: true,
                buttons: {
                    "Apagar todos os livros": function () {
                        window.location.href = '{{ action('Admin\PontoController@destroy', ['id' => $ponto->id]) }}';
                    },
                    Cancel: function () {
                        $(this).dialog("close");
                    }
                }
            });
        });

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