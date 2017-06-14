<?php
// source: C:\xampp\htdocs\OnlyChat_project\app\presenters/templates/Account/default.latte

use Latte\Runtime as LR;

class Templateb821745fdf extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'_updade_person' => 'blockUpdade_person',
	];

	public $blockTypes = [
		'content' => 'html',
		'_updade_person' => 'html',
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
    <div id='main_panel' class="container-fluid">
        <div id='div_input'>
            <div>
                <h3 id="podnadpis_up">Osobné údaje</h3>
<div id="<?php echo htmlSpecialChars($this->global->snippetDriver->getHtmlId('updade_person')) ?>"><?php
		$this->renderBlock('_updade_person', $this->params) ?></div>            </div>
            <div>
                <h3 style="color: white; margin-left: 33%" id="podnadpis_upEnd">Opustiť</h3>
                <h3 style="color: white; margin-left: 33%" id="podnadpis_upEnd">Lonely Road.</h3>
                <form action="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Account:deletePerson")) ?>" method="post" onsubmit="return confirm('Naozaj chcete opustiť Lonely road?')">
                    <input id="Button" style="width: 71%; height: 60%; margin-left: 31%"  type="submit" value="Opustiť Lonely road.">
                </form>  
            </div> 
        </div>        

    </div>
<?php
	}


	function blockUpdade_person($_args)
	{
		extract($_args);
		$this->global->snippetDriver->enter("updade_person", "static");
		/* line 7 */ $_tmp = $this->global->uiControl->getComponent("updatePersonForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(NULL, FALSE);
		$_tmp->render();
		$this->global->snippetDriver->leave();
		
	}

}
