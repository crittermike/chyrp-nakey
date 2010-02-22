<?php
    define('JAVASCRIPT', true);
    require_once "../../../includes/common.php";
    error_reporting(0);
    header("Content-Type: application/x-javascript");
?>
<!-- --><script>
$(function(){
    $(".notice, .warning, .message").
        append("<span class=\"sub\"><?php echo __("(click to hide)", "theme"); ?></span>").
        click(function(){
            $(this).fadeOut("fast");
        })
        .css("cursor", "pointer");

    if ($.browser.safari)
        $("input#search").attr({
            placeholder: "<?php echo __("Search...", "theme"); ?>"
        });

    if ($("#debug").size())
        $("#wrapper").css("padding-bottom", $("#debug").height());

    $("#debug .toggle").click(function(){
        if (Cookie.get("hide_debug") == "true") {
            Cookie.destroy("hide_debug");
            $("#debug h5:first span").remove();
            $("#debug").animate({ height: "33%" });
        } else {
            Cookie.set("hide_debug", "true", 30);
            $("#debug").animate({ height: 15 });
            $("#debug ul li").each(function(){
                $("<span class=\"sub\"> | "+ $(this).html() +"</span>").appendTo("#debug h5:first");
            })
        }
    })

    $("input#slug").live("keyup", function(e){
        if (/^([a-zA-Z0-9\-\._:]*)$/.test($(this).val()))
            $(this).css("background", "")
        else
            $(this).css("background", "#ff2222")
    })

    if (Cookie.get("hide_debug") == "true") {
        $("#debug").height(15);
        $("#debug ul li").each(function(){
            $("<span class=\"sub\"> | "+ $(this).html() +"</span>").appendTo("#debug h5:first");
        })
    }

		$('#header #search').DefaultValue('clicky typey searchy');

		$(".photo_image a").fancybox();
})

jQuery.fn.DefaultValue = function(text){
    return this.each(function(){
		    if(this.type != 'text' && this.type != 'password' && this.type != 'textarea')
		      return;
		    var fld_current=this;
		        if(this.value=='') {
		      this.value=text;
		    } else {
		      return;
		    }
		    $(this).focus(function() {
		      if(this.value==text || this.value=='')
		        this.value='';
		    });
		    $(this).blur(function() {
		      if(this.value==text || this.value=='')
		        this.value=text;
		    });
		    $(this).parents("form").each(function() {
		      $(this).submit(function() {
		        if(fld_current.value==text) {
		          fld_current.value='';
		        }
		      });
		    });
    });
};
<!-- --></script>
