$(document).ready(function () {
    $(function () {
        $.nette.init();
    });

    /* Volání AJAXu u všech odkazů s třídou ajax */
    $("a").on("click", ".ajax", function (event) {
        //event.preventDefault();
        $.get(this.href);
        
    });

    /* AJAXové odeslání formulářů */
    $("form").on("submit", ".ajax", function () {
        $(this).ajaxSubmit();
        
    });

    $("form").on("click", ".ajax :submit", function () {
        $(this).ajaxSubmit();
       
        return false;
    });

    $(document).ajaxComplete(function () {
        $('#flashMessage').show();
        setTimeout(function () {
            $("#flashMessage").hide();
        }, 1000);
    });

    $("#createNewRoom").click(function () {
        $('#newRoom .close').click();
    });

});


