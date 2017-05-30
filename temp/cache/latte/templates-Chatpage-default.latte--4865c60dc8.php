<?php
// source: C:\xampp\htdocs\OnlyChat_project\app\presenters/templates/Chatpage/default.latte

use Latte\Runtime as LR;

class Template4865c60dc8 extends Latte\Runtime\Template
{
	public $blocks = [
		'head' => 'blockHead',
		'content' => 'blockContent',
		'_list' => 'blockList',
		'_form' => 'blockForm',
	];

	public $blockTypes = [
		'head' => 'html',
		'content' => 'html',
		'_list' => 'html',
		'_form' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('head', get_defined_vars());
?>

<?php
		$this->renderBlock('content', get_defined_vars());
		?> <?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['message'])) trigger_error('Variable $message overwritten in foreach on line 72');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockHead($_args)
	{
		extract($_args);
?>

<style>
    .message-bubble 
    {
        padding: 10px 0px 10px 0px;
    }

    .message-bubble:nth-child(even) { background-color: #F5F5F5; }

    .message-bubble > *
    {
        padding-left: 10px;    
    }

    .panel-body { padding: 0px; }

    .panel-heading { background-color: #3d6da7 !important; color: white !important; }

    #chatPanelMain {
        position: absolute;
        top: 46.2%;
        left: 50%;
        transform: translate(-50%, -50%);
        height: 77%;
        width: 90%;
        background-color: #3d6da7;
    }

    #middleScroll {
        overflow-x: hidden;
        overflow-y: scroll;
        height: 100%;
        width: 100%;
        background-color: white;
    }

    #panel-footer {
        position: absolute;
        bottom: 0%;
        height: 10%;
        width: 90.1%;
        left: 5%;
    }

    #usermsg {
        border-radius: 0%; 
        width: 93.64%;
    }

    #submitmsg {
        border-radius: 0%; 
        width: 6.36%;
    }

</style>
<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<div class="container" style="display: block">

    <div id="chatPanelMain">
        <div class="panel-heading">Chatuješ ako: <?php echo LR\Filters::escapeHtmlText($person->login) /* line 64 */ ?>. V miestnosti: <?php
		echo LR\Filters::escapeHtmlText($room->title) /* line 64 */ ?></div>
        
        <div id="middleScroll" class="container">

            <div class="panel-body">
<div id="<?php echo htmlSpecialChars($this->global->snippetDriver->getHtmlId('list')) ?>"><?php $this->renderBlock('_list', $this->params) ?></div>                </div>

            </div>              

        </div>    


        <div style="display: inline; width: 100%" class="input-group">
<div id="<?php echo htmlSpecialChars($this->global->snippetDriver->getHtmlId('form')) ?>"><?php $this->renderBlock('_form', $this->params) ?></div>        </div> 
    </div>
</body>

<?php
	}


	function blockList($_args)
	{
		extract($_args);
		$this->global->snippetDriver->enter("list", "static");
?>
                <div class="container">
                    
<?php
		$iterations = 0;
		foreach ($messages as $message) {
?>
                            
                                <div class="row message-bubble">
                                    <p class="text-muted"><?php echo LR\Filters::escapeHtmlText($message->time) /* line 75 */ ?> || <?php
			echo LR\Filters::escapeHtmlText($message->login) /* line 75 */ ?></p>
                                    <span><?php echo LR\Filters::escapeHtmlText($message->text) /* line 76 */ ?></span>
                                </div>
                            
<?php
			$iterations++;
		}
		$this->global->snippetDriver->leave();
		
	}


	function blockForm($_args)
	{
		extract($_args);
		$this->global->snippetDriver->enter("form", "static");
		/* line 90 */ $_tmp = $this->global->uiControl->getComponent("sendMessageForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(NULL, FALSE);
		$_tmp->render();
		$this->global->snippetDriver->leave();
		
	}

}
