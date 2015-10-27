<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Casa dos Meninos - Biblioteca</title>
<link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/plugins/spinner/ui.spinner.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/spinner/jquery.mousewheel.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/plugins/forms/uniform.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/forms/jquery.cleditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/forms/jquery.validationEngine-en.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/forms/jquery.validationEngine.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/forms/jquery.tagsinput.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/forms/autogrowtextarea.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/forms/jquery.maskedinput.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/forms/jquery.dualListBox.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/forms/jquery.inputlimiter.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/forms/chosen.jquery.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/plugins/wizard/jquery.form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/wizard/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/wizard/jquery.form.wizard.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/plugins/tables/datatable.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/tables/tablesort.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/tables/resizable.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/plugins/ui/jquery.tipsy.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/ui/jquery.collapsible.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/ui/jquery.prettyPhoto.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/ui/jquery.progress.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/ui/jquery.timeentry.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/ui/jquery.colorpicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/ui/jquery.jgrowl.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/ui/jquery.breadcrumbs.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/ui/jquery.sourcerer.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

</head>

<body class="nobg loginPage">


<!-- Main content wrapper -->
<div class="loginWrapper">
    <div class="loginLogo"><img src="{{ asset('images/loginLogo.png') }}" alt="" /></div>
    <div class="widget">
        <div class="title"><img src="{{ asset('images/icons/dark/files.png') }}" alt="" class="titleIcon" /><h6>Login</h6></div>
        <form id="validate" method="post" class="form" action="{{ action('AuthController@login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset>
                <div class="formRow">
                    <label for="login">E-mail:</label>
                    <div class="loginInput"><input type="text" name="email" class="validate[required]" id="email" /></div>
                    <div class="clear"></div>
                </div>
                
                <div class="formRow">
                    <label for="pass">Senha:</label>
                    <div class="loginInput"><input type="password" name="senha" class="validate[required]" id="senha" /></div>
                    <div class="clear"></div>
                </div>
                
                <div class="loginControl">
                    <div class="rememberMe"><input type="checkbox" id="remMe" name="remMe" /><label for="remMe">Manter logado</label></div>
                    <input type="submit" value="Entrar" class="dredB logMeIn" />
                    <div class="clear"></div>
                </div>
            </fieldset>
        </form>

    </div>
    <span style="float: right">Não tem cadastro? <a href="http://login.basecomum.org.br">Clique aqui</a></span>
</div>

<!-- Footer line -->
<div id="footer">
    <div class="wrapper">Todos os direitos reservados &copy; {{ date('Y') }}. Feito por <a href="http://rasouza.com.br" title="">R. A. Souza</a></div>
</div>

@if ($errors->first('login'))
    <script type="text/javascript">
        $.jGrowl("{{ $errors->first('login') }}", { sticky: true });
    </script>
@endif

</body>
</html>