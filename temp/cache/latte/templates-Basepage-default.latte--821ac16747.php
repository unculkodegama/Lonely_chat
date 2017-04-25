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
?>

<?php
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
		if (isset($this->params['room'])) trigger_error('Variable $room overwritten in foreach on line 86');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockHead($_args)
	{
		extract($_args);
?>

<style>
    #nadpis {
        font-family: "Courier New", sans-serif;
        font-weight: bold;
        font-size: 28px;
        color: #000000;
        margin: 0px;
        text-decoration: none;
        padding: 5px 30px;        
    }

    #themes {
        border: 2px solid black;
        padding-top: 0.1%;
        padding-bottom: 1%;
        margin: 0.3%;
        background: rgba(210, 212, 221, 0.8);
        width: 32.6%;
        max-width: 32.6%;
    } 

    #Theme_name {
        color: black;
        font-family: 'Palatino Linotype', serif;
        left: 42.5%;
        display: inline;            
    }

    #add_local_theme{
        float: right;
    }

    #KKK {
        padding-top: 0.7%;
        padding-bottom: 0.7%;   
    }

    #popis {
        display: inline;
    }

</style>
<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<body id="body_image" style='background-image: url("<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($basePath)) /* line 50 */ ?>/images/obr1.JPG")'>

    <!-- Menu -->
    <header>
        <div class="menu">
            <div class="container-fluid">
                <div class="navbar-header">
                    <h1 id="nadpis"><a id="link_main" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Basepage:default")) ?>">Lonely Road.</a></h1>
                </div>
                <div>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="" data-toggle="modal" data-target="#newRoom" ><span class="glyphicon glyphicon-comment"></span>  Nová miestnosť </a></li>

                        <li><a  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Message:default")) ?>"><span class="glyphicon glyphicon-envelope"></span>  Správy (0)</a></li>

                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                                <span class="glyphicon glyphicon-cog"></span>  Možnosti</a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Account:default")) ?>">Profil</a></li>
                                <li><a href="#">Zmena hesla</a></li>
                                              
                            </ul>
                        </li>
                        <li><a href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 74 */ ?>/sign/out"><span class="glyphicon glyphicon-log-in"></span>  Odhlásiť sa</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

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
                        <div id="themes" class="col-md-4">
                            <div style="overflow-wrap: break-word">
                                <h3> <?php echo LR\Filters::escapeHtmlText($room->title) /* line 89 */ ?> </h3>

                                <p id='popis' style="overflow: hidden;"> <?php echo LR\Filters::escapeHtmlText($room->description) /* line 91 */ ?> </p>
                            </div>
                            </br>
<?php
				if ($room->locked == 't') {
?>
                                <span class="glyphicon glyphicon-lock"></span>
<?php
				}
?>

                            <a ><button id='add_local_theme'> Vstúpiť </button></a>

<?php
				if ($room->id_users == $user->id) {
?>
                                <a href="" data-toggle="modal" data-target="#roomSettings" ><button id='add_local_theme'> Upravit Miestnosť </button></a>
                                <!--  $room->id_rooms -->
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
		/* line 131 */ $_tmp = $this->global->uiControl->getComponent("newRoomForm");
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
                
<!-- Room settings modal -->

<div class="modal fade" id="roomSettings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h3 class="modal-title" id="myModalLabel">Úprava miestnosťi</h3>
            </div>
            <div class="modal-body">
<?php
		/* line 151 */ $_tmp = $this->global->uiControl->getComponent("editRoomForm");
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
