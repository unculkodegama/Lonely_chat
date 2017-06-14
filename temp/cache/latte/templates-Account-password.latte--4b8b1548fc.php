<?php
// source: C:\xampp\htdocs\OnlyChat_project\app\presenters/templates/Account/password.latte

use Latte\Runtime as LR;

class Template4b8b1548fc extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'_updade_password' => 'blockUpdade_password',
	];

	public $blockTypes = [
		'content' => 'html',
		'_updade_password' => 'html',
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
<div id="<?php echo htmlSpecialChars($this->global->snippetDriver->getHtmlId('updade_password')) ?>"><?php
		$this->renderBlock('_updade_password', $this->params) ?></div>            </div>
        </div>        


    </div>
</body>

<?php
	}


	function blockUpdade_password($_args)
	{
		extract($_args);
		$this->global->snippetDriver->enter("updade_password", "static");
		/* line 12 */ $_tmp = $this->global->uiControl->getComponent("updatePasswordForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(NULL, FALSE);
		$_tmp->render();
		$this->global->snippetDriver->leave();
		
	}

}
