  $(function() {
    $('#slides').slidesjs({
      width: 960,
      height: 300,
      navigation: {
            active: false,
            effect: "slide"
          },
      pagination:{
        active: false
      },
      play: {
        active: false,
        interval: 5000,
        auto: true
      }
    });
	
$('.footer ul.social li a').prepend('<span class="sicon"> </span>');
$('.footer ul.social li a').hover(function() {
$(this).find('.sicon').css("background-color","rgba(0,0,0,0.9)");
                },
				function() {
$(this).find('.sicon').css("background-color","rgba(0,0,0,0.2)");
                });
});