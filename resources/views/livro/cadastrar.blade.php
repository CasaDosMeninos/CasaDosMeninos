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

			<form id="cadastrarLivro" method="post" class="form validate" action="{{ action('LivroController@store') }}" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="validado" id="validado" value="0">
				<fieldset class="step" id="cadastrarLivro1">
					<h1>Etapa 1/2</h1>
					<div class="formRow">
						<label for="isbn">ISBN:</label>
						<div class="formRight">
							<input type="text" name="isbn" id="isbn" />
							<a href="#" class="wizard-next"><span class="formNote">Este livro não possui ISBN? Clique aqui</span></a>
						</div>
						<div class="clear"></div>
					</div>
				</fieldset>
				<fieldset id="cadastrarLivro2" class="step">
					<h1>Etapa 2/2</h1>
					<div class="formRow">
						<label for="titulo">Título:*</label>
						<div class="formRight"><input type="text" name="titulo" id="titulo" class="validate[required]" /></div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<label for="edicao">Edição:</label>
						<div class="formRight"><input type="text" name="edicao" id="edicao" /></div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<label for="ano">Ano:</label>
						<div class="formRight"><input type="text" name="ano" id="ano" /></div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<label for="paginas">Páginas:</label>
						<div class="formRight"><input type="text" name="paginas" id="paginas" /></div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<label for="editora">Editora:</label>
						<div class="formRight"><input type="text" name="editora" id="editora" /></div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<label for="autor">Autor:*</label>
						<div class="formRight"><input type="text" name="autor" id="autor" class="validate[required]" /></div>
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

</div>


@stop

@section('js')
<script type="text/javascript">

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
			textSubmit: 'Cadastrar'
		})
		.bind("step_shown", function(event, data){
			if (data.currentStep == 'cadastrarLivro2') {
				var wcAPI = 'http://xisbn.worldcat.org/webservices/xid/isbn/' + $('#isbn').val() + '?callback=?';
				var req = {
					method: 'getMetadata',
					format: 'jsonp',
					crossDomain: true,
					fl: 'author,ed,publisher,title,year'
				};
				$.ajax({
					url: 'http://xisbn.worldcat.org/webservices/xid/isbn/' + $('#isbn').val(),
					data: req,
					type: 'GET',
					crossDomain: true,
					dataType: 'jsonp',
					success: function(data) {
						if (data.stat == 'ok') {
							var book = data.list[0];
							$('#titulo').val(book.title);
							$('#editora').val(book.publisher);
							$('#autor').val(book.author);
							$('#ano').val(book.year);
							$('#edicao').val(book.ed);
							$('#validado').val(1);
						}
					},
					error: function() { alert('Failed!'); },
				});

			};
		});

		$('.wizard-next').click(function() {
            $("#cadastrarLivro").formwizard('next');
        });
	});
</script>
@stop