<?php
// source: C:\xampp\htdocs\OnlyChat_project\app\presenters/templates/Basepage/editRoom.latte

use Latte\Runtime as LR;

class Template01f1d176b0 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'_editRoom' => 'blockEditRoom',
	];

	public $blockTypes = [
		'content' => 'html',
		'_editRoom' => 'html',
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
<div id="<?php echo htmlSpecialChars($this->global->snippetDriver->getHtmlId('editRoom')) ?>"><?php $this->renderBlock('_editRoom', $this->params) ?></div></div>
<?php
	}


	function blockEditRoom($_args)
	{
		extract($_args);
		$this->global->snippetDriver->enter("editRoom", "static");
		/* line 7 */ $_tmp = $this->global->uiControl->getComponent("editRoomForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(NULL, FALSE);
		$_tmp->render();
		$this->global->snippetDriver->leave();
		
	}

}
