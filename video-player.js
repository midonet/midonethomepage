$(function () {

  $('#channel-tabs').tabs();

  $(window).resize(function () {
    $('#vplayer').dialog('option', 'position', 'center');
  });

  $('.video-item-container').mouseenter(function () {
    $(this).addClass('bggry');
  });

  $('.video-item-container').mouseleave(function () {
    $(this).removeClass('bggry');
  });

  $( "#vplayer").dialog({
    autoOpen: false,
    minHeight: 410,
    minWidth: 670,
    draggable: false,
    resizable: false,
    modal: true,
    dialogClass: 'tv-dialog',
    show: {
      effect: 'slideDown',
      duration: 350
    },
    hide: {
      effect: "slideUp",
      duration: 300
    },
    close: function(event, ui) {
      $('#vframe').attr('src', '');
    }
  });

  $('img.video-thumb').click(function () {
    $('#vframe').attr('src', '//youtube.com/embed/' + $(this).data('url'));
    $('#vplayer').html('<iframe id="vframe" width="640" height="360" src="' + $(this).data('url') + '?autoplay=1&fullscreen=1" frameborder="0" allowfullscreen></iframe>');
    $('.ui-dialog-title').text($(this).attr('title'));
    $('#vplayer').dialog('open');
  });

  $('img.slide-thumb').click(function () {
    $('#vframe').attr('src', $(this).data('url'));
    $('#vplayer').html('<iframe id="vframe" src="' + $(this).data('url') + '" width="425" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" style="border:1px solid #CCC; border-width:1px; margin-bottom:5px; max-width: 100%;" allowfullscreen> </iframe>');
    $('.ui-dialog-title').text($(this).attr('title'));
    $('#vplayer').dialog('open');
  });

  $("a.video-play").click(function () {
    $parent = $(this).parent().parent().find('img.video-thumb');

    $('#vplayer').html('<iframe id="vframe" width="640" height="360" src="//youtube.com/embed/' + $parent.attr('alt') + '?autoplay=1&fullscreen=1" frameborder="0" allowfullscreen></iframe>');
    $('.ui-dialog-title').text($parent.attr('title'));
    $('#vplayer').dialog('open');
  });

});
