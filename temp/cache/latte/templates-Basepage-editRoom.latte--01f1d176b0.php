<?php
// source: C:\xampp\htdocs\OnlyChat_project\app\presenters/templates/Basepage/editRoom.latte

use Latte\Runtime as LR;

class Template01f1d176b0 extends Latte\Runtime\Template
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

<div id="divEditRoom">
<?php
		/* line 6 */ $_tmp = $this->global->uiControl->getComponent("editRoomForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(NULL, FALSE);
		$_tmp->render();
?>
</div>
<?php
	}

}
