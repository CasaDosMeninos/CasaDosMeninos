@extends('layouts.master')

@section('title')
	Cadastrar livros
@stop

@section('subtitle')
	Entre com o ISBN do livro que você quer cadastrar ou cadastre-o manualmente pelo link "Este livro não possui ISBN"
@stop

@section('sub-nav')
@stop

@section('content')
<div class="widgets">
	<div class="oneTwo">
		<div class="widget">
			<div class="title"><img src="{{ asset('images/icons/dark/signPost.png') }}" alt="" class="titleIcon" />
				<h6>Atribuir ponto de troca</h6>
			</div>
			
			<form id="" class="form" action="{{ action('LivroController@create') }}">
				<table cellpadding="0" cellspacing="0" width="100%" class="sTable">
	                <thead>
	                    <tr>
	                    	<td width="1"></td>
	                        <td>Nome</td>
	                        <td>Bairro</td>
	                    </tr>
	                </thead>
	                <tbody>
	                	@foreach ($pontos as $ponto)
	                    <tr>
	                    	<td><input type="radio" name="ponto" value="{{ $ponto->id }} value="radio-{{ $ponto->id }}"></td>
	                        <td><a href="#" title="{{ $ponto->endereco }}" class="tipN"><strong>{{ $ponto->nome }}</strong></a></td>

	                        <td>{{ $ponto->bairro }}</td>
	                    </tr>
	                    @endforeach
	                </tbody>
	            </table>
				<div class="wizButtons"> 
					<span class="wNavButtons">
						<input class="blueB ml10" value="Atribuir" type="submit" />
					</span>
				</div>
				<div class="clear"></div>
			</form>
		</div>
	</div>

	<div class="oneTwo">
		<div class="widget">
			<div class="title"><img src="{{ asset('images/icons/dark/globe.png') }}" alt="" class="titleIcon" />
				<h6>Pontos</h6>
			</div>
			<div id="googleMap" style="width:100%;height:380px;"></div>
		</div>
	</div>
</div>


@stop

@section('js')
<script type="text/javascript">

	/* Google MAPS
	================================================== */
	function initialize() {
		var mapOptions = {
			zoom: 14,
			center: new google.maps.LatLng(-23.653026, -46.747006),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL
			}
		}

		var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);

		// Adiciona os marcadores de Ponto de troca
		@foreach ($pontos as $ponto)

			new google.maps.Marker({
			    position: new google.maps.LatLng({{ $ponto->latitude }}, {{ $ponto->longitude }}),
			    map: map,
			    title: '{{ $ponto->nome }}'
			});

		@endforeach
	}

	function loadScript() {
		var script = document.createElement("script");
		script.type = "text/javascript";
		script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyBChny4Xq0nUt2dOsEEMbM3szFSV1oViyA&sensor=false&callback=initialize";
		document.body.appendChild(script);
	}

	window.onload = loadScript;

	/* Form Wizard
	================================================== */
	$(function() {
		oTable = $('.dTable').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",
			"sDom": '<""l>t<"F"fp>'
		});
	});
</script>
@stop