<?php
// source: C:\xampp\htdocs\OnlyChat_project\app\presenters/templates/Chatpage/default.latte

use Latte\Runtime as LR;

class Template4865c60dc8 extends Latte\Runtime\Template
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
		?> <?php
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
    #nadpis {
        font-family: "Courier New", sans-serif;
        font-weight: bold;
        font-size: 28px;
        color: #000000;
        margin: 0px;
        text-decoration: none;
        padding: 5px 30px;        
    }

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

</style>
<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<body id="body_image" style='background-image: url("<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($basePath)) /* line 35 */ ?>/images/obr1.JPG")'>

    <header>
        <div class="menu">
            <div class="container-fluid">
                <div class="navbar-header">
                    <h1 id="nadpis"><a id="link_main" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Basepage:default")) ?>">Lonely Road.</a></h1>
                </div>
                <div>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Chatpage:default")) ?>"><span class="glyphicon glyphicon-comment"></span>  Nová miestnosť </a></li>

                        <li><a  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Message:default")) ?>"><span class="glyphicon glyphicon-envelope"></span>  Správy (0)</a></li>

                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                                <span class="glyphicon glyphicon-cog"></span>  Možnosti</a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Account:default")) ?>">Profil</a></li>
                                <li><a href="#">Zmena hesla</a></li>         
                            </ul>
                        </li>
                        <li><a href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 57 */ ?>/sign/default"><span class="glyphicon glyphicon-log-in"></span>  Odhlásiť sa</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

                    

    <div id='main_panel' class="container-fluid">

        <div class="container">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Panel heading without title</div>
                    <div class="panel-body">
                        <div class="container">
                            <div class="row message-bubble">
                                <p class="text-muted">Matt Townsen</p>
                                <span>Why is yo shit so broke?</span>
                            </div>
                            <div class="row message-bubble">
                                <p class="text-muted">Matt Townsen</p>
                                <p>It Isn't'</p>
                            </div>
                            <div class="row message-bubble">
                                <p class="text-muted">Matt Townsen</p>
                                <p>Umm yes it is</p>
                            </div>
                            <div class="row message-bubble">
                                <p class="text-muted">Matt Townsen</p>
                                <p>Test message</p>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="input-group">
                                <input type="text" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Send</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</body>

<footer id='foot'> © 2017 By: Marek Unčík, For: Webové Aplikace (LS 2017)</footer>
<?php
	}

}
