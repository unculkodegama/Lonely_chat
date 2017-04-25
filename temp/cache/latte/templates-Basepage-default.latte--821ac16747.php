<?php
// source: C:\xampp\htdocs\OnlyChat_project\app\presenters/templates/Basepage/default.latte

use Latte\Runtime as LR;

class Template821ac16747 extends Latte\Runtime\Template
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
?>

<?php
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
    #nadpis {
        font-family: "Courier New", sans-serif;
        font-weight: bold;
        font-size: 28px;
        color: #000000;
        margin: 0px;
        text-decoration: none;
        padding: 5px 30px;        
    }

    #themes {
        border: 2px solid black;
        padding-top: 0.1%;
        padding-bottom: 1%;
        margin: 0.3%;
        background: rgba(210, 212, 221, 0.7);
        width: 32%;
    }

    #theme_container {
        border: 2px solid black;
        padding-bottom: 1%;
        padding-left: 2%;
        padding-right: 2%;
        margin-top: 0.5%;
        background: rgba(88, 106, 183, 0.3);
    }

    #Theme_name {
        color: black;
        font-family: 'Palatino Linotype', serif;
        left: 42.5%;
        display: inline;            
    }

    #add_local_theme{
        float: right;
    }

    #KKK {
        padding-top: 0.7%;
        padding-bottom: 0.7%;   
    }

    #popis {
        display: inline;
    }

</style>
<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<body id="body_image" style='background-image: url("<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($basePath)) /* line 58 */ ?>/images/obr1.JPG")'>

    <!-- Menu -->
    <header>
        <div class="menu">
            <div class="container-fluid">
                <div class="navbar-header">
                    <h1 id="nadpis"><a id="link_main" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Basepage:default")) ?>">Lonely Road.</a></h1>
                </div>
                <div>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="" data-toggle="modal" data-target="#login-modal" ><span class="glyphicon glyphicon-comment"></span>  Nová miestnosť </a></li>

                        <li><a  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Message:default")) ?>"><span class="glyphicon glyphicon-envelope"></span>  Správy (0)</a></li>

                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                                <span class="glyphicon glyphicon-cog"></span>  Možnosti</a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Account:default")) ?>">Profil</a></li>
                                <li><a href="#">Zmena hesla</a></li>
                                              
                            </ul>
                        </li>
                        <li><a href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 82 */ ?>/sign/out"><span class="glyphicon glyphicon-log-in"></span>  Odhlásiť sa</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

                    
    <!-- Vyber miestnosti -->

    <div id='main_panel' class="container-fluid">

        <div class="container-fluid">
            <div class="row">
                <div id="theme_container" class="col-md-12">
                    <div id='KKK' class='row'> 
                        <h2 id="Theme_name"> Názov nadtémy </h2>

                        <a href="" data-toggle="modal" data-target="#login-modal" > <button id='add_local_theme'> Pridať miestnosť </button> </a>
                    </div>
                    <div class="row">
                        <div id="themes" class="col-xs-6 col-md-4">
                            <h3> Názov miestnosti </h3>
                            <p id='popis'> Popis miestnosti </p>
                            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Chatpage:default")) ?>"><button id='add_local_theme'> Vstúpiť </button></a>
                        </div>

                        <div id="themes" class="col-xs-6 col-md-4">
                            <h3> Názov miestnosti </h3>
                            <p id='popis'> Popis miestnosti </p>
                            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Chatpage:default")) ?>"><button id='add_local_theme'> Vstúpiť </button></a>
                        </div>

                        <div id="themes" class="col-xs-6 col-md-4">
                            <h3> Názov miestnosti </h3>
                            <p id='popis'> Popis miestnosti </p>
                            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Chatpage:default")) ?>"><button id='add_local_theme'> Vstúpiť </button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="main_block" class="container-fluid">
            <div class="row">
                <div id="theme_container" class="col-md-12">
                    <div id='KKK' class='row'> 
                        <h2 id="Theme_name"> Názov nadtémy </h2>
                        <a href="" data-toggle="modal" data-target="#login-modal" > <button id='add_local_theme'> Pridať miestnosť </button> </a> 
                    </div>
                    <div class="row">
                        <div id="themes" class="col-xs-6 col-md-4">
                            <h3> Názov miestnosti </h3>
                            <p id='popis'> Popis miestnosti </p>
                            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Chatpage:default")) ?>"><button id='add_local_theme'> Vstúpiť </button></a>
                        </div>

                        <div id="themes" class="col-xs-6 col-md-4">
                            <h3> Názov miestnosti </h3>
                            <p id='popis'> Popis miestnosti </p>
                            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Chatpage:default")) ?>"><button id='add_local_theme'> Vstúpiť </button></a>
                        </div>

                        <div id="themes" class="col-xs-6 col-md-4">
                            <h3> Názov miestnosti </h3>
                            <p id='popis'> Popis miestnosti </p>
                            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Chatpage:default")) ?>"><button id='add_local_theme'> Vstúpiť </button></a>
                        </div>

                        <div id="themes" class="col-xs-6 col-md-4">
                            <h3> Názov miestnosti </h3>
                            <p id='popis'> Popis miestnosti </p>
                            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Chatpage:default")) ?>"><button id='add_local_theme'> Vstúpiť </button></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>     

    </div>
</body>


<!-- Modal Okno -->

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h3 class="modal-title" id="myModalLabel">Vytvorte novú miestnosť</h3>
            </div>
            <div class="modal-body">
                <form>
                    <h3>Nadpis miestnosti</h3>
                    <input type="text"> </input>
                    <h3>Popis miestnosti</h3>
                    <input type="text"> </input>
                    <h3>Vyberte kategóriu</h3>

                    <div class="form-group">
                        <label for="sel1">Select list (select one):</label>
                        <select class="form-control" id="sel1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                        <br>
                        </form>        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="" data-dismiss="modal">Zavrieť</button>
                        <button type="button" class="" data-dismiss="modal"> Vytvoriť </button>
                    </div>
            </div>
        </div>
    </div>

    <footer id='foot'> © 2017 By: Marek Unčík, For: Webové Aplikace (LS 2017)</footer>
<?php
	}

}
