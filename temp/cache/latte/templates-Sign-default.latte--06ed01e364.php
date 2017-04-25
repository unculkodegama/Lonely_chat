<?php
// source: C:\xampp\htdocs\OnlyChat_project\app\presenters/templates/Sign/default.latte

use Latte\Runtime as LR;

class Template06ed01e364 extends Latte\Runtime\Template
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
    #header_nadpis {
        position: absolute;
        top: 30%;
        left: 50%;
        transform: translate(-45%, -50%);
    }

    #div_input {        
        position: fixed;
        top: 70%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    #Button, #input {
        margin-bottom: 10px; 
        color: #ffffff;
        background: rgba(7,12,104,0.2);
        border: 3px solid #ffffff;
        padding: 8px;
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



    input:hover::-webkit-input-placeholder {
        color: black;
    }

    input:hover:-moz-placeholder {
        color: black;
    }

    input:hover::-moz-placeholder {
        color: black;
    }

    input:hover:-ms-input-placeholder {
        color: black;
    }

</style>   

<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<body id="body_image" style='background-image: url("<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($basePath)) /* line 68 */ ?>/images/obr1.JPG")'>
    <div id="header_nadpis">

        <h1 id="nadpis_velky">Lonely Road.</h1>

    </div>
    <div id="podnadpis_def">
        <h4 id="slogan"> A place where all strangers meet. </h4>
    </div>    

    <div id="div_input">

<?php
		/* line 80 */ $_tmp = $this->global->uiControl->getComponent("signInForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(NULL, FALSE);
		$_tmp->render();
?>

        <div>
            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("up")) ?>"><button id="Button" type="button" style="width: 100%"> Registrácia </button></a>
        </div>
    </div>
</body>

<footer id='foot'> © 2017 By: Marek Unčík, For: Webové Aplikace (LS 2017)</footer>

<?php
	}

}
