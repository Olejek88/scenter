$(document).ready(function() {
    //$.cookie('test', '123');

    if ($.cookie('LOGONSESSIONID') != null) {
        $('#header_top_username', this).css('display', 'block');
        $('#header_top_logout', this).css('display', 'block');
        $('#header_top_login', this).css('display', 'block');
    }
    else {
        //$('#header_top_username', this).css('display', 'none');
        //$('#header_top_login', this).css('display', 'none');
        //$('#header_top_logout', this).css('display', 'block');			
        $('#header_top_username', this).css('display', 'block');
        $('#header_top_login', this).css('display', 'block');
        $('#header_top_logout', this).css('display', 'block');
    }

    if ($.cookie('vlln') != null) {
        $("#hdr_username").text($.cookie('vlln'));
    }

    $('#mainNavigationLeft li').hover(
			function() {
			    $('ul', this).css('display', 'block');
			    $('ul', this).css('z-index', '6000');
			},
			function() { $('ul', this).css('display', 'none'); });

    $('#mainNavigationMiddle li').hover(
			function() {
			    $('ul', this).css('display', 'block');
			    $('ul', this).css('z-index', '6000');
			},
			function() {
			    $('ul', this).css('display', 'none');
			}
    );

    $('#mainNavigationMiddle li.2ndmenu').hover(
			function() { $('ul', this).css('visibility', 'visible'); },
			function() { $('ul', this).css('visibility', 'hidden'); });
/*
    $('#header_top_login').toggle(
			function() { $('ul', this).css('display', 'block'); },
			function() { $('ul', this).css('display', 'none'); }),
		    function() { $('#headerdropdown', this).css('display', 'block') };
 */
});