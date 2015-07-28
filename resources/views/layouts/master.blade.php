<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>Casa dos Meninos - Biblioteca</title>
<link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/plugins/spinner/ui.spinner.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/spinner/jquery.mousewheel.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.ui.datepicker-pt-BR.js') }}"></script>

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

<body>

<!-- Left side content -->
<div id="leftSide">
    <div class="logo"><a href="index.html"><img src="{{ asset('images/logo.png') }}" alt="" /></a></div>
    
    <div class="sidebarSep mt0"></div>
    
    <!-- Search widget -->
    <form action="" class="sidebarSearch">
        <input type="text" name="search" placeholder="procurar..." id="ac" />
        <input type="submit" value="" />
    </form>
    
    <div class="sidebarSep"></div>
    
    <!-- Left navigation -->
    @section('nav')
    <ul id="menu" class="nav">
        <li class="dash"><a href="{{ route('home') }}" title="" class="{{ setActive(['home']) }}"><span>Home</span></a></li>
        <li class="book"><a href="#" title="" class="{{ setActive(['livro.consultar', 'livro.cadastrar'], 'exp') }}"><span>Livros</span></a>
            <ul class="sub">
                <li><a href="{{ route('livro.cadastrar') }}"  title="">Cadastrar</a></li>
                <li class="last"><a href="{{ route('livro.consultar') }}" title="">Consultar</a></li>
            </ul>
        </li>
        <li class="sign-post">
            <a href="{{ route('ponto.index') }}" class="{{ setActive(['ponto.index']) }}" title=""><span>Pontos de Troca</span></a>
        </li>
        <li class="clock"><a href="#" title=""><span>Histórico</span></a></li>
        <li class="tables"><a href="#" title="" class="exp"><span>Solicitações</span><strong>8</strong></a>
            <ul class="sub">
                <li><a href="{{ route('emprestimo.meus_pedidos') }}" title="">Meus pedidos</a></li>
                <li><a href="{{ route('emprestimo.solicitacoes') }}" title="">Solicitações para mim</a></li>
                <li><a href="#" title="">Concluir Empréstimo</a></li>
                <li class="last"><a href="#" title="">Todas Solicitações</a></li>
            </ul>
        </li>
        @if (Auth::user()->admin)
        <li class="admin-user">
            <a href="#" title="" class="{{ setActive(['admin.temas', 'admin.validar', 'admin.livros', 'admin.pontos'], 'exp') }}"><span>Administrador</span></a>
            <ul class="sub">
                <li><a href="{{ route('admin.temas') }}" title="">Temas</a></li>
                <li><a href="{{ route('admin.validar') }}" title="">Validar Livro</a></li>
                <li><a href="{{ route('admin.livros') }}" title="">Editar Livro</a></li>
                <li class="last"><a href="{{ route('admin.pontos') }}" title="">Pontos de Troca</a></li>
            </ul>
        </li>
        @endif
    </ul>
    @show
</div>


<!-- Right side -->
<div id="rightSide">

    <!-- Top fixed navigation -->
    @section('top-nav')
    <div class="topNav">
        <div class="wrapper">
            <div class="welcome">
                <a href="#" title=""><img src="{{ asset('images/userPic.png') }}" alt="" /></a>
                <span>Olá, @if (Auth::user()) {{ Auth::user()->name }} @else convidado @endif</span>
            </div>
            <div class="userNav">
                <ul>
                    <li>
                        <a href="#" title="">
                            <img src="{{ asset('images/icons/topnav/profile.png') }}" alt="" />
                            <span>Perfil</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="">
                            <img src="{{ asset('images/icons/topnav/messages.png') }}" alt="" />
                            <span>Notificações</span>
                            <span class="numberTop">8</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('auth.logout') }}" title="">
                            <img src="{{ asset('images/icons/topnav/logout.png') }}" alt="" />
                            <span>@if (Auth::user()) Logout @else Login @endif</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    @show
    
    <!-- Responsive header -->
    @section('resp-nav')
    <div class="resp">
        <div class="respHead">
            <a href="index.html" title=""><img src="{{ asset('images/loginLogo.png') }}" alt="" /></a>
        </div>
        
        <div class="cLine"></div>
        <div class="smalldd">
            <span class="goTo"><img src="{{ asset('images/icons/light/home.png') }}" alt="" />Home</span>
            <ul class="smallDropdown">
                <li class="dash"><a href="#" title="" class="active"><span>Home</span></a></li>
                <li class="book"><a href="#" title="" class="exp"><span>Livros</span></a>
                    <ul>
                        <li><a href="#" title="">Cadastrar</a></li>
                        <li class="last"><a href="#" title="">Consultar</a></li>
                    </ul>
                </li>
                <li class="sign-post"><a href="#" title=""><span>Pontos de Troca</span></a></li>
                <li class="clock"><a href="#" title=""><span>Histórico</span></a></li>
                <li class="tables"><a href="#" title="" class="exp"><span>Solicitações</span><strong>8</strong></a>
                    <ul>
                        <li><a href="#" title="">Meus pedidos</a></li>
                        <li><a href="#" title="">Solicitações para mim</a></li>
                        <li><a href="#" title="">Concluir Empréstimo</a></li>
                        <li class="last"><a href="#" title="">Todas Solicitações</a></li>
                    </ul>
                </li>
                <li class="admin-users"><a href="#" title="" class="exp"><span>Administrador</span></a>
                    <ul>
                        <li><a href="#" title="">Temas</a></li>
                        <li><a href="#" title="">Validar Livro</a></li>
                        <li><a href="#" title="">Editar Livro</a></li>
                        <li class="last"><a href="#" title="">Pontos de Troca</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="cLine"></div>
    </div>
    @show
    
    <!-- Title area -->
    @section('title-area')
    <div class="titleArea">
        <div class="wrapper">
            <div class="pageTitle">
                <h5>@yield('title')</h5>
                <span>@yield('subtitle')</span>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="line"></div>
    @show
    
    <!-- Page statistics and control buttons area -->
    @section('sub-nav')
    <div class="statsRow">
        <div class="wrapper">
            <div class="controlB">
                <ul>
                    <li><a href="#" title=""><img src="{{ asset('images/icons/control/32/plus.png') }}" alt="" /><span>Add new session</span></a></li>
                    <li><a href="#" title=""><img src="{{ asset('images/icons/control/32/database.png') }}" alt="" /><span>New DB entry</span></a></li>
                    <li><a href="#" title=""><img src="{{ asset('images/icons/control/32/hire-me.png') }}" alt="" /><span>Add new user</span></a></li>
                    <li><a href="#" title=""><img src="{{ asset('images/icons/control/32/statistics.png') }}" alt="" /><span>Check statistics</span></a></li>
                    <li><a href="#" title=""><img src="{{ asset('images/icons/control/32/comment.png') }}" alt="" /><span>Review comments</span></a></li>
                    <li><a href="#" title=""><img src="{{ asset('images/icons/control/32/order-149.png') }}" alt="" /><span>Check orders</span></a></li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    
    <div class="line"></div>
    @show
    
    <!-- Main content wrapper -->
    <div class="wrapper">
        @yield('content')    
    </div>
    
    <!-- Footer line -->
    <div id="footer">
        <div class="wrapper">Todos os direitos reservados &copy; {{ date('Y') }}. Feito por <a href="http://rasouza.com.br" title="">R. A. Souza</a></div>
    </div>

</div>

<div class="clear"></div>

@yield('js')

</body>
</html>