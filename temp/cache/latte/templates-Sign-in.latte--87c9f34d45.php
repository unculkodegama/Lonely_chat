<?php
// source: C:\xampp\htdocs\OnlyChat_project\app\presenters/templates/Sign/in.latte

use Latte\Runtime as LR;

class Template87c9f34d45 extends Latte\Runtime\Template
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

    #body_image {
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    #header_nadpis {
        position: absolute;
        top: 30%;
        left: 50%;
        transform: translate(-45%, -50%);
    }

    #nadpis {
        font-family: "Courier New", sans-serif;
        font-size: 600%;
        color: #000000;
    }

    #podnadpis {
        font-family: "Century Gothic", sans-serif;
        position: absolute;
        top: 40%;
        left: 50%;
        transform: translate(-45%, -50%);         
    }

    #slogan {
        text-align: center;
        font-size: 200%;
        color: #000000;
    }

    #div_input {        
        position: fixed;
        top: 70%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    #foot {
        position:absolute;
        bottom: 0;
        left: 50%;
        transform: translate( -50%);
        font-size: 18px;
        color: #f7f7f9;
    }

    #Button, #input {
        margin-bottom: 10px; 
        color: #ffffff;
        background: rgba(7,12,104,0.2);
        border: 3px solid #ffffff;
        padding: 8px;
        font-size: large;
        text-align: center;
        font-weight: bold;
        transition: color 0.1s ease-out,
            background-color 0.1s ease-out,
            border-color 0.1s ease-out;
    }

    #Button:hover, #Button:active, #input:active, #input:hover {
        background-color: #ffffff;
        border-color: #070c68;
        color: #000000;
        background: rgba(255,255,255,0.3);
        transition: color 0.1s ease-in,
            background-color 0.1s ease-in,
            border-color 0.1s ease-in;
    }

    .form-controla::-webkit-input-placeholder {
        color:#ffffff;
        font-weight: bold;
        opacity: 1 !important;

    }
    .form-controla:-moz-placeholder { /* Firefox 18- */
        color:#ffffff;
        font-weight: bold;
        opacity: 1 !important;
    }

    .form-controla::-moz-placeholder { /* Firefox 19+ */
        color:#ffffff;
        font-weight: bold;
        opacity: 1 !important;
    }

    .form-controla:-ms-input-placeholder {
        opacity: 1 !important;
        color:#ffffff;
        font-weight: bold;
    }

    input:hover::-webkit-input-placeholder {
        color: black;
    }

    input:hover:-moz-placeholder {
        color: black;
    }

    input:hover::-moz-placeholder {
        color: black;
    }

    input:hover:-ms-input-placeholder {
        color: black;
    }


</style>   

<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<body id="body_image" style='background-image: url("<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($basePath)) /* line 128 */ ?>/images/obr1.JPG")'>
    <div id="header_nadpis">

        <h1 id="nadpis">Lonely Road.</h1>

    </div>
    <div id="podnadpis">
        <h4 id="slogan"> A place where all strangers meet. </h4>
    </div>    

    <form>
        <div id="div_input">
            <div>
                <input class="form-controla" id="input" type="text" placeholder="Meno" required>
            </div>
            <div>
                <input class="form-controla" id="input" type="password" placeholder="Heslo" required>
            </div>
            <div>
                <a href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 147 */ ?>/basepage"><button id="Button" type="button" style="width: 100%"> Prihlásiť sa </button></a>
            </div> 
            <div>
                <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("up")) ?>"><button id="Button" type="button" style="width: 100%"> Registrácia </button></a>
            </div>
    </form> 
</div>
</body>

<footer id='foot'> © 2017 By: Marek Unčík, For: Webové Aplikace (LS 2017)</footer>

<?php
	}

}
