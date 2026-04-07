var scroll = window.requestAnimationFrame ||
             function(callback){ window.setTimeout(callback, 1000/60)};
var elementsToShow = document.querySelectorAll('.show-on-scroll'); 

function loop() {
    Array.prototype.forEach.call(elementsToShow, function(element){
      if (isElementInViewport(element)) {
        element.classList.add('is-visible');
      } else {
        element.classList.remove('is-visible');
      }
    });
    scroll(loop);
}

loop();

function isElementInViewport(el) {
  if (typeof jQuery === "function" && el instanceof jQuery) {
    el = el[0];
  }
  var rect = el.getBoundingClientRect();
  return (
    (rect.top <= 0
      && rect.bottom >= 0)
    ||
    (rect.bottom >= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.top <= (window.innerHeight || document.documentElement.clientHeight))
    ||
    (rect.top >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight))
  );
}

$(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('.back-to-top').fadeIn('slow');
    } else {
      $('.back-to-top').fadeOut('slow');
    }
});
  
$('.back-to-top').click(function() {
    $('html, body').animate({
      scrollTop: 0
    }, 1500, 'easeInOutExpo');
    return false;
});

function myFunction(x) {
	x.classList.toggle("change");
  document.getElementById("myDropdown").classList.toggle("show");
  document.getElementById("navbtn").classList.toggle("bg-gray");
}

// $('#search').on("click", function() {
//   $('#zipcopy').val($('#zip').val());
//   $('#zipcopy').trigger("change");
// });
$(window).ready( function() {
   //$(".page").append( "<div class='wp-navi-border'></div>" );
   $("<div class='wp-navi-border'></div>").insertAfter(".page");
   $("<div class='wp-navi-border'></div>").insertAfter(".current");
   $(".wp-navi-border:last-of-type").hide();
   $(".menu-link").click(function() {
	$(".mobile-nav-toggle").click();
   })
});

// $(document).on('keyup', '#zip', function(e){
//   var code = $(this).val();
//   var key = event.keyCode || event.charCode;

//   if($(this).val().length == 3){
//        if( key == 8 || key == 46 ){
//        }
//        else{
//           $(this).val(code+'-'); 
//        }						
//   }
//   if($(this).val().indexOf('--') !== -1){
//       $(this).val(code.replace('--','-'));					
//   }
// });

var acc = document.getElementsByClassName("accordion");
var i;
var j;
for (i = 0; i < acc.length; i++) {
	acc[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var arrow = this.children;
		console.log(arrow[0].className);
		var panel = this.previousElementSibling;
		if (panel.classList.contains("hide")) {
			panel.classList.remove("hide");
			document.querySelector("." + arrow[0].className).style.transform = 'rotate(135deg) translate(8px, -8px)';
		} else {
			panel.classList.add("hide");
			document.querySelector("." + arrow[0].className).style.transform = 'rotate(-45deg)';
		} 
	});
}

