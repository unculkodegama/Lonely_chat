<?php
// source: C:\xampp\htdocs\OnlyChat_project\app\presenters/templates/Sign/up.latte

use Latte\Runtime as LR;

class Template9af806a121 extends Latte\Runtime\Template
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

    #header_nadpis {
        position: fixed;
        top: 5%;
        left: 50%;
        transform: translate(-45%, -50%);
        padding-bottom: 1%;
    }

    #blok {
        margin-bottom: auto;
        width: 100%;
        padding-bottom: 0px;
    }

</style>   

<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<body id="body_image" style='background-image: url("<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($basePath)) /* line 32 */ ?>/images/obr1.JPG")'>
    <div id="header_nadpis">
        <h2 id="nadpis_up">Lonely Road.</h2>

    </div>    

    <div id='div_input'>
        <div id='blok'>
            <h3 id="podnadpis_up">Registrácia</h3>
            <p style="color: black; font-size: medium">Už ste zaregistrovaný?<a style="color: black; font-size: medium" href="<?php
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:default")) ?>"> Prihláste sa.</a></p>
<?php
		/* line 42 */ $_tmp = $this->global->uiControl->getComponent("signUpForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(NULL, FALSE);
		$_tmp->render();
?>
        </div>
    </div>
</body>

<footer id='foot'> © 2017 By: Marek Unčík, For: Webové Aplikace (LS 2017)</footer>

<div class="modal" id="flashMessageSingUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <div class="modal-body">
                <div>Informácie boli upravené.</div>
            </div>
        </div>
    </div>
</div>

<?php
	}

}
