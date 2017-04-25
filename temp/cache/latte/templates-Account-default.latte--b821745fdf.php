<?php
// source: C:\xampp\htdocs\OnlyChat_project\app\presenters/templates/Account/default.latte

use Latte\Runtime as LR;

class Templateb821745fdf extends Latte\Runtime\Template
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

    #div_input {        
        position: fixed;
        top: 47%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    #blok {
        margin-bottom: auto;
        padding-bottom: 0px;
    }

    #Button, #input {
        margin-bottom: 10px; 
        color: #ffffff;
        background: rgba(7,12,104,0.2);
        border: 3px solid #ffffff;
        padding: 2%;
        font-size: large;
        text-align: center;
        font-weight: bold;
        transition: color 0.1s ease-out,
            background-color 0.1s ease-out,
            border-color 0.1s ease-out;
    }

    #Button:hover, #Button:active, #input:active, #input:hover {
        background-color: #ffffff;
        border-color: #070c68;
        color: #000000;
        background: rgba(255,255,255,0.3);
        transition: color 0.1s ease-in,
            background-color 0.1s ease-in,
            border-color 0.1s ease-in;
    }

</style>
<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<body id="body_image" style='background-image: url("<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($basePath)) /* line 46 */ ?>/images/obr1.JPG")'>

    <header>
        <div class="menu">
            <div class="container-fluid">
                <div class="navbar-header">
                    <h1 id="nadpis"><a id="link_main" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Basepage:default")) ?>">Lonely Road.</a></h1>
                </div>
                <div>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Chatpage:default")) ?>"><span class="glyphicon glyphicon-comment"></span>  Nová miestnosť </a></li>

                        <li><a  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Message:default")) ?>"><span class="glyphicon glyphicon-envelope"></span>  Správy (0)</a></li>

                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                                <span class="glyphicon glyphicon-cog"></span>  Možnosti</a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Account:default")) ?>">Profil</a></li>
                                <li><a href="#">Zmena hesla</a></li>
                                              
                            </ul>
                        </li>
                        <li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:default")) ?>"><span class="glyphicon glyphicon-log-in"></span>  Odhlásiť sa</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>



    <div id='main_panel' class="container-fluid">
        <form>
            <div id='div_input'>
                <div id='blok'>
                    <h3 id="podnadpis_up"> Základné informácie </h3>
                    <div>
                        <input id='input' type="text" class="form-controla" placeholder="Prihlasovacie meno"> 
                    </div>
                    <div>
                        <input id='input' type="text" class="form-controla" placeholder='Prezývka'>
                    </div>
                    <div>
                        <input id='input' type="email" class="form-controla" placeholder='E-mail'>
                    </div>

                    <h3 id="podnadpis_up" > Osobné informácie </h3>

                    <div>
                        <input id='input' type="text" class="form-controla" placeholder='Meno'>
                    </div>
                    <div>
                        <input id='input' type="text" class="form-controla" placeholder='Priezvisko'>
                    </div>
                    <div>
                        <input id='input' type="text" class="form-controla" placeholder='Mesto'>
                    </div>
                </div>

                <div style="float:left">
                    <input name="re" id="radio-m" type="radio"><label for="radio-m" id="labela">Muž</label> 
                </div>
                <div style="float: right">
                    <input name="re" id="radio-f" type="radio"><label for="radio-f" id="labela">Žena</label>
                </div>
                <br>
                <div id="saving">    
                    <a href="#"><button id='Button' type="button">Uložiť</button></a>
                </div>
            </div>        

        </form>  
    </div>
</body>

<footer id='foot'> © 2017 By: Marek Unčík, For: Webové Aplikace (LS 2017)</footer>
<?php
	}

}
