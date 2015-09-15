@extends('layouts.master')

@section('title')
	Atribuir ponto de troca
@stop

@section('subtitle')
	Escolhe um ponto de troca que deseja disponibilizar este livro para quando alguém te pedir emprestado
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

			<form id="formPonto" class="form" action="{{ action($act) }}" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
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

	@include('partials.mapa', ['lat' => $ponto->latitude, 'lng' => $ponto->longitude])
</div>


@stop

@section('js')
<script type="text/javascript">
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