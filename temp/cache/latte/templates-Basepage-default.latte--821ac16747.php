<?php
// source: C:\xampp\htdocs\OnlyChat_project\app\presenters/templates/Basepage/default.latte

use Latte\Runtime as LR;

class Template821ac16747 extends Latte\Runtime\Template
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
?>


<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['room'])) trigger_error('Variable $room overwritten in foreach on line 39');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockHead($_args)
	{
		extract($_args);
?>

<style>
    #themes {
        border: 2px solid black;        
        padding-bottom: 1%;
        margin: 0.3%;
        background: rgba(210, 212, 221, 0.8);
        width: 32.6%;
        max-width: 32.6%;
    } 

    #add_local_theme{
        float: right;
    }

    #popis {
        display: inline;
    }

    #spanSubmit{
        float: right;
        display: inline;
        color: red;
    }
</style>

<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<body>

    <div class="container-fluid">

        <div class="row" id="theme_container">
<?php
		if ($rooms != null) {
?>
                <div >
<?php
			$iterations = 0;
			foreach ($rooms as $room) {
?>
                        <div id="themes"  class="col-md-4">
                            <div style="overflow-wrap: break-word; display: inline">
                                <div style="width: 100%;">
                                    <p style="float: left; margin-bottom: -1px"> <?php echo LR\Filters::escapeHtmlText($room->created) /* line 43 */ ?> </p>    
<?php
				if ($room->id_users == $user->id) {
					?>                                        <form action="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Basepage:deleteRoom", [$room->id_rooms])) ?>" method="post" onsubmit="return confirm('Naozaj chcete miestnosť: <?php
					echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeJs($room->title)) /* line 45 */ ?> vymazať?')">
                                            <a href="" onClick="$(this).closest('form').submit()" id="spanSubmit"><span class="glyphicon glyphicon-remove-sign"></span></a>
                                        </form>
<?php
				}
?>
                                </div>
                                
                                <h3 style="border-top: #000 1px solid;"> <?php echo LR\Filters::escapeHtmlText($room->title) /* line 51 */ ?> </h3>

                                <p id='popis' style="overflow: hidden;"> <?php echo LR\Filters::escapeHtmlText($room->description) /* line 53 */ ?> </p>
                            </div>
                            </br>
<?php
				if ($room->locked == 't') {
?>
                                <span class="glyphicon glyphicon-lock"></span>
<?php
				}
				if ($room->locked != 't') {
					?>                                <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Chatpage:default", [$room->id_rooms])) ?>"><button id='add_local_theme'> Vstúpiť </button></a>
<?php
				}
				if ($room->id_users == $user->id) {
					?>                                <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Basepage:editRoom", [$room->id_rooms])) ?>"><button id='add_local_theme'> Upravit Miestnosť </button></a>

<?php
				}
?>
                        </div>
<?php
				$iterations++;
			}
?>

<?php
		}
		if ($rooms == null) {
?>
                    <div>
                        <h1> V chate sa nenachádzajú žiadne miestnosti. </h1>
                        <h3> Vytvorte ju spolu s nami. </h3>
                    </div>
<?php
		}
?>
            </div>
        </div>  
</body>


<!-- New Room modal -->
<div class="modal fade" id="newRoom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h3 class="modal-title" id="myModalLabel">Vytvorte novú miestnosť</h3>
            </div>
            <div class="modal-body">
<?php
		/* line 90 */ $_tmp = $this->global->uiControl->getComponent("newRoomForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(NULL, FALSE);
		$_tmp->render();
?>
            </div>
            <div class="modal-footer">
                <button type="button" class="" data-dismiss="modal">Zavrieť</button>

            </div>
        </div>
    </div>
</div>



<?php
	}

}
