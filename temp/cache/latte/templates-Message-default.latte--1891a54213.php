<?php
// source: C:\xampp\htdocs\OnlyChat_project\app\presenters/templates/Message/default.latte

use Latte\Runtime as LR;

class Template1891a54213 extends Latte\Runtime\Template
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
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockHead($_args)
	{
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<body id="body_image" style='background-image: url("<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($basePath)) /* line 7 */ ?>/images/obr1.JPG")'>

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
                        <li><a href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 30 */ ?>/sign/default"><span class="glyphicon glyphicon-log-in"></span>  Odhlásiť sa</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

                    

    <div id='main_panel' class="container-fluid">

     
        
    </div>
</body>

<footer id='foot'> © 2017 By: Marek Unčík, For: Webové Aplikace (LS 2017)</footer>
<?php
	}

}
