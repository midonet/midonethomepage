jQuery(document).ready(function() {
jQuery("#channel-tabs" ).tabs();
jQuery(window).resize(function() {
    jQuery("#vplayer").dialog("option", "position", "center");
});

jQuery(".video-item-container").mouseenter(function(){
jQuery(this).addClass('bggry');
});

jQuery( ".video-item-container").mouseleave(function(){
jQuery(this).removeClass('bggry');
});



jQuery( "#vplayer").dialog({
      autoOpen: false,
	  minHeight:410,
	  minWidth:670,
	  draggable:false,
	  resizable:false,
	  modal:true,
	  dialogClass: 'tv-dialog',
      show: {
        effect: "slideDown",	
		duration: 350
      },
      hide: {
        effect: "slideUp",
        duration: 300
      },
	  close: function( event, ui ) {
	  jQuery("#vframe").attr('src','');
	  
	  }  
	  
    });

	 jQuery("img.video-thumb").click(function () {
	// alert(jQuery(this).attr('title'));
	jQuery("#vframe").attr('src','//youtube.com/embed/'+jQuery(this).data('url'));
	 jQuery("#vplayer").html('<iframe id="vframe" width="640" height="360" src="'+jQuery(this).data('url')+'?autoplay=1&fullscreen=1" frameborder="0" allowfullscreen></iframe>');
jQuery( ".ui-dialog-title" ).text(jQuery(this).attr('title'));
	   jQuery( "#vplayer" ).dialog( "open" );
	   
 
  });
  
  jQuery("img.slide-thumb").click(function () {
	// alert(jQuery(this).attr('title'));
	jQuery("#vframe").attr('src',jQuery(this).data('url'));
	 jQuery("#vplayer").html('<iframe id="vframe" src="'+jQuery(this).data('url')+'" width="425" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" style="border:1px solid #CCC; border-width:1px; margin-bottom:5px; max-width: 100%;" allowfullscreen> </iframe>');
jQuery( ".ui-dialog-title" ).text(jQuery(this).attr('title'));
	   jQuery( "#vplayer" ).dialog( "open" );
	   
 
  });
  jQuery("a.video-play").click(function () {
	// alert(jQuery(this).attr('title'));
	$parent =jQuery(this).parent().parent().find("img.video-thumb");
	
	//jQuery("#vframe").attr('src','//youtube.com/embed/'+$parent.attr('title'));
	 jQuery("#vplayer").html('<iframe id="vframe" width="640" height="360" src="//youtube.com/embed/'+$parent.attr('alt')+'?autoplay=1&fullscreen=1" frameborder="0" allowfullscreen></iframe>');
jQuery( ".ui-dialog-title" ).text($parent.attr('title'));
	   jQuery( "#vplayer" ).dialog( "open" );
	   
 
  });
  
  
	   
    });