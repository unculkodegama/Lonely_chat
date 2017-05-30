<?php
// source: C:\xampp\htdocs\OnlyChat_project\app\presenters/templates/Chatpage/@layout.latte

use Latte\Runtime as LR;

class Templated61c6e2f08 extends Latte\Runtime\Template
{
	public $blocks = [
		'head' => 'blockHead',
		'scripts' => 'blockScripts',
	];

	public $blockTypes = [
		'head' => 'html',
		'scripts' => 'html',
	];


	function main()
	{
		extract($this->params);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <title><?php
		if (isset($this->blockQueue["title"])) {
			$this->renderBlock('title', $this->params, function ($s, $type) {
				$_fi = new LR\FilterInfo($type);
				return LR\Filters::convertTo($_fi, 'html', $this->filters->filterContent('striphtml', $_fi, $s));
			});
			?> | <?php
		}
?>Lonely road.</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 9 */ ?>/css/style.css">
        <?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('head', get_defined_vars());
?>
    </head>

    <body id="body_image" style='background-image: url("<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($basePath)) /* line 13 */ ?>/images/obr1.JPG")'>
<?php
		$iterations = 0;
		foreach ($flashes as $flash) {
			?>        <div<?php if ($_tmp = array_filter(['flash', $flash->type])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>><?php
			echo LR\Filters::escapeHtmlText($flash->message) /* line 14 */ ?></div>
<?php
			$iterations++;
		}
?>

        <!-- Menu -->
        <header>
            <div class="menu">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <h1 id="nadpisLogo"><a id="link_main" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Basepage:default")) ?>">Lonely Road.</a></h1>
                    </div>
                    <div>
                        <ul class="nav navbar-nav navbar-right">



                            <li><a  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Message:default")) ?>"><span class="glyphicon glyphicon-envelope"></span>  Správy (0)</a></li>

                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                                    <span class="glyphicon glyphicon-cog"></span>  Možnosti</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Account:default")) ?>">Profil</a></li>
                                    <li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Account:password")) ?>">Zmena hesla</a></li>
                                                  
                                </ul>
                            </li>
                            <li><a href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 39 */ ?>/sign/out"><span class="glyphicon glyphicon-log-in"></span>  Odhlásiť sa</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

<?php
		$this->renderBlock('content', $this->params, 'html');
?>




<?php
		$this->renderBlock('scripts', get_defined_vars());
?>

    </body>
</html><?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['flash'])) trigger_error('Variable $flash overwritten in foreach on line 14');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockHead($_args)
	{
		
	}


	function blockScripts($_args)
	{
		extract($_args);
?>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>        
        <script src="/OnlyChat_project/www/js/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>        
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://nette.github.io/resources/js/netteForms.min.js"></script>
        <script type="text/javascript" src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 62 */ ?>/js/nette.ajax.js"></script>
        
        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 64 */ ?>/js/jquery.min.js"></script>
        <
        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 66 */ ?>/js/nette.ajax.js"></script> 
        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 67 */ ?>/js/main.js"></script>
<?php
	}

}
