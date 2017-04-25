<?php
// source: C:\xampp\htdocs\OnlyChat_project\app\presenters/templates/Basepage/in.latte

use Latte\Runtime as LR;

class Templatebff18a706d extends Latte\Runtime\Template
{
	public $blocks = [
		'head' => 'blockHead',
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'head' => 'html',
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('head', get_defined_vars());
?>

<?php
		$this->renderBlock('content', get_defined_vars());
?>

<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockHead($_args)
	{
		extract($_args);
?>


<style>
    #body_image {
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    #nadpis {
        font-family: "Courier New", sans-serif;
        font-weight: bold;
        font-size: 28px;
        color: #000000;
        margin: 0px;
        text-decoration: none;
        padding: 5px 30px;        
    }

    .menu {
        background: rgba(44, 47, 81, 0.6);
        border-bottom: 4px solid #222a68;
        width:100%;
        height: auto;
        padding: 0 10px;
        position: fixed;
        margin: 0px;
        z-index: 1;    
    }

    .menu  .navbar-nav > .active > a {
        background-color : #04A3ED;
        color: white;
        font-weight: bold;
    }

    .menu  .navbar-nav >  li >  a {
        font-size: 15px;
        color: white;
        padding: 10px 35px;
    }
    .menu  .navbar-nav >  li >  a:hover {
        background-color: #04A3ED;
    }

    .navbar-header > a {
        font-family: 'Ubuntu Condensed', sans-serif;
        padding: 0px;
        margin: 0px;
        text-decoration: none;
        color: white;
        font-size: 25px;
        padding: 5px 30px;
        opacity: 1 !important;
    }

    .navbar-header > a:hover {
        text-decoration: none;
        color: #04A3ED;
    }

    #main_panel {
        width: 98%;
        height: 90%;
        border: 2px #18273f solid;
        top: 51.3%;
        left: 50%;
        transform: translate(-50%, -50%);
        position: fixed;
        background: rgba(199, 213, 237, 0.6);
    }

    #foot {
        position:absolute;
        bottom: 0;
        left: 50%;
        transform: translate(-50%);
        font-size: 16px;
        color: #f7f7f9;
    }

    #a {
        width: 98%;
        padding-top: 10px;
    }
    
    #p {
        border: 2px solid black;
    }
</style>
<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<body id="body_image" style='background-image: url("<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($basePath)) /* line 97 */ ?>/images/obr1.JPG")'>

    <header>
        <div class="menu">
            <div class="container-fluid">
                <div class="navbar-header">
                    <h1 id="nadpis">Lonely Road.</h1>
                </div>
                <div>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" ><span class="glyphicon glyphicon-comment"></span>  Správy (0)</a></li>

                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                                <span class="glyphicon glyphicon-cog"></span>  Možnosti</a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Profil</a></li>
                                <li><a href="#">Zmena hesla</a></li>
                                              
                            </ul>
                        </li>
                        <li><a href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 118 */ ?>/sign/in"><span class="glyphicon glyphicon-log-in"></span>  Odhlásiť sa</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>


    <div id='main_panel'>
        <div id="a" class="container-fluid">
            <div class="row">
                <div id="p" class="col-md-12">
                    Level 1: .col-sm-9
                    <div class="row">
                        <div class="col-xs-4 col-sm-4">
                            Level 2: .col-xs-8 .col-sm-6
                        </div>
                        <div class="col-xs-4 col-sm-4">
                            Level 2: .col-xs-4 .col-sm-6
                        </div>
                    </div>
                </div>
            </div>
        </div>     





    </div>
</body>

<footer id='foot'> © 2017 By: Marek Unčík, For: Webové Aplikace (LS 2017)</footer>
<?php
	}

}
