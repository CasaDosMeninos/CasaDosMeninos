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
			<div class="title"><img src="{{ asset('images/icons/dark/pencil.png') }}" alt="" class="titleIcon" />
				<h6>Cadastrar livro</h6>
			</div>
			
			{!! Form::open(array(
				'action' => 'LivroController@create',
				'id' => 'cadastrarLivro',
				'class' => 'form')) 
			!!}

				<fieldset class="step" id="cadastrarLivro1">
					<h1>Etapa 1/3</h1>
					<div class="formRow">
						<label>ISBN:</label>
						<div class="formRight">
							<input type="text" name="isbn" />
							<a href="#" class="wizard-next"><span class="formNote">Este livro não possui ISBN? Clique aqui</span></a>
						</div>
						<div class="clear"></div>
					</div>
				</fieldset>
				<fieldset id="cadastrarLivro2" class="step">
					<h1>Etapa 2/3</h1>
					<div class="formRow">
						<label>Título</label>
						<div class="formRight"><input type="text" name="titulo" id="titulo" /></div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<label>Edição:</label>
						<div class="formRight"><input type="text" name="edicao" id="edicao" /></div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<label>Ano:</label>
						<div class="formRight"><input type="text" name="ano" id="ano" /></div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<label>Páginas:</label>
						<div class="formRight"><input type="text" name="paginas" id="paginas" /></div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<label>Editora:</label>
						<div class="formRight"><input type="text" name="editora" id="editora" /></div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<label>Autor:</label>
						<div class="formRight"><input type="text" name="autor" id="autor" /></div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<label>Tema:</label>
						<div class="formRight">{!! Form::select('tema_id', $temas) !!}</div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<label>Imagem:</label>
						<div class="formRight"><input type="file" name="imagem" id="imagem"></div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<label>Ponto de troca:</label>
						<div class="formRight">
							<input type="radio" checked="checked" name="tipo-ponto" id="radio1" value="casa" class="link" />
							<label for="radio1">Minha casa</label>
							<input type="radio" name="tipo-ponto" id="radio2" value="fora" class="link" />
							<label for="radio2">Outro ponto de troca</label>
						</div>
						<div class="clear"></div>
					</div>
				</fieldset>
				<fieldset class="step" id="casa">
					<h1>Etapa 3/3</h1>
					<div class="formRow">
						<label>Endereço:</label>
						<div class="formRight">
							<input type="text" name="endereco" />
						</div>
						<div class="clear"></div>
					</div>
				</fieldset>
				<fieldset class="step" id="fora" class="submit_step">
					<h1>Etapa 3/3</h1>		
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
					<div class="clear"></div>
				</fieldset>
				<div class="wizButtons"> 
					<span class="wNavButtons">
						<input class="basic" id="back" value="Voltar" type="reset" />
						<input class="blueB ml10" id="next" value="Próximo" type="submit" />
					</span>
				</div>
				<div class="clear"></div>
			</form>
			<div class="data" id="w3"></div>
		</div>
	</div>

	<div class="oneTwo hide">
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
			$("#cadastrarLivro").formwizard({
				formPluginEnabled: false, 
				validationEnabled: false,
				focusFirstInput : true,
				disableUIStyles : true,
				textNext: 'Próximo',
				textBack: 'Voltar',
				textSubmit: 'Cadastrar',
				submitStepClass: 'submit_step'
			});
			$('.wizard-next').click(function(event) {
				$('#cadastrarLivro').formwizard('next');
			});
			$("#cadastrarLivro").bind("step_shown", function(event, data){
				if (data.currentStep == 'cadastrarLivro2') {
					// @TODO: Populate second step form
				};
			});
	});
</script>
@stop