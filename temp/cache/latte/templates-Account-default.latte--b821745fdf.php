<?php
// source: C:\xampp\htdocs\OnlyChat_project\app\presenters/templates/Account/default.latte

use Latte\Runtime as LR;

class Templateb821745fdf extends Latte\Runtime\Template
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
                <h3 id="podnadpis_up">Osobné údaje</h3>
                <h5 id="podnadpis_upReg"> Registovaný: </h5>
                
<?php
		/* line 11 */ $_tmp = $this->global->uiControl->getComponent("updatePersonForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(NULL, FALSE);
		$_tmp->render();
?>
            </div>
            <div>
                <h3 style="color: white" id="podnadpis_up">Opustiť</h3>
                <h3 style="color: white" id="podnadpis_up">Lonely Road.</h3>
                <form action="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Account:deletePerson")) ?>" method="post" onsubmit="return confirm('Naozaj chcete opustiť Lonely road?')">
                    <input id="Button"  type="submit" value="Opustiť Lonely road.">
                </form>
            </div> 
        </div>        


    </div>
</body>

<?php
	}

}
