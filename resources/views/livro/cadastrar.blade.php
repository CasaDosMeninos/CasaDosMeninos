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
					'action' => 'LivroController@postCadastrar',
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
		                    	<input type="radio" checked="checked" name="ponto" id="radio1" value="casa" class="link" />
		                    	<label for="radio1">Minha casa</label>
                            	<input type="radio" name="ponto" id="radio2" value="fora" class="link" />
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
		            <fieldset class="step" id="fora">
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
					<div class="wizButtons"> 
						<span class="wNavButtons">
		                    <input class="basic" id="back3" value="Voltar" type="reset" />
		                    <input class="blueB ml10" id="next3" value="Próximo" type="submit" />
		                </span>
					</div>
		            <div class="clear"></div>
				</form>
				<div class="data" id="w3"></div>
		    </div>
		</div>
	</div>
@stop