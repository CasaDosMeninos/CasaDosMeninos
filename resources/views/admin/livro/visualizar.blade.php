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
                    @if($livro->validado != TRUE)
                    <li>
                        <a href="{{ action('Admin\LivroController@validar', ['id' => $livro->id]) }}" title="">
                            <img src="{{ asset('images/icons/control/32/check.png') }}" alt="" />
                            <span>Validar</span>
                        </a>
                    </li>
                    @endif

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

    <div id="dialog-confirm" class="hide" title="Apagar todos os empréstimos deste livro?">
        <p>
            <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
            Todos os registros de empréstimos pertencentes a este livro serão deletados. Você tem certeza?
        </p>
    </div>
@stop

@section('content')

    <form action="{{ action('Admin\LivroController@update') }}" method="POST" class="form validate" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $livro->id }}">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="{{ asset('images/icons/dark/list.png') }}" alt="" class="titleIcon" />
                    <h6>Livro</h6>
                </div>

                <div class="formRow">
                    <label>&Uacute;ltima modifica&ccedil;&atilde;o:</label>
                    <div class="formRight">
                        {{ $livro->updated_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label>Criado em:</label>
                    <div class="formRight">
                        {{ $livro->created_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label>ISBN:</label>
                    <div class="formRight">
                        <input type="text" name="isbn" value="{{ $livro->isbn }}" />
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label>Título:*</label>
                    <div class="formRight">
                        <input type="text" name="titulo" id="titulo" value="{{ $livro->titulo }}" class="validate[required]" /></div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Edição:</label>
                    <div class="formRight"><input type="text" name="edicao" id="edicao" value="{{ $livro->edicao }}" /></div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Ano:</label>
                    <div class="formRight"><input type="text" name="ano" id="ano" value="{{ $livro->ano }}" /></div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Páginas:</label>
                    <div class="formRight"><input type="text" name="paginas" id="paginas" value="{{ $livro->paginas }}" /></div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Editora:</label>
                    <div class="formRight"><input type="text" name="editora" id="editora" value="{{ $livro->editora }}" /></div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Autor:*</label>
                    <div class="formRight"><input type="text" name="autor" id="autor" class="validate[required]" value="{{ $livro->autor }}" /></div>
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
                        <a href="{{ route('livro.ponto') }}"><strong>{{ $livro->ponto->nome }}</strong></a>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formSubmit"><input type="submit" value="Enviar" class="blueB" /></div>
            </div>
        </fieldset>
    </form>
@stop

@section('js')
    @if (old('cadastro') != null)
        <script type="text/javascript">
            // Mensagem de erro se existir algum
            $.jGrowl("{{ old('cadastro') }}");
        </script>
    @endif

    <script type="text/javascript">
        $('select[name="tema_id"] option[value={{ $livro->tema_id }}]').attr('selected', 'selected');

        $('a#deletar').click(function(){
            $('#dialog-confirm').dialog({
                height:160,
                modal: true,
                buttons: {
                    "Apagar todos os empréstimos": function () {
                        window.location.href = '{{ action('Admin\LivroController@destroy', ['id' => $livro->id]) }}';
                    },
                    Cancel: function () {
                        $(this).dialog("close");
                    }
                }
            });
        });
    </script>
@stop