<?php
// source: C:\xampp\htdocs\OnlyChat_project\app\presenters/templates/Account/password.latte

use Latte\Runtime as LR;

class Template4b8b1548fc extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<body>

    <div id='main_panel' class="container-fluid">
        <div id='div_input'>
            <div>
                <h3 id="podnadpis_up">Zmena hesla</h3>
<?php
		/* line 11 */ $_tmp = $this->global->uiControl->getComponent("updatePasswordForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(NULL, FALSE);
		$_tmp->render();
?>
            </div>
        </div>        


    </div>
</body>

<?php
	}

}