/*
|--------------------------------------------------------------------------
| script.js file is part of ydcoza
|--------------------------------------------------------------------------
|
| Created by Michael ydcoza
| Last Updated: ydcozadate
|
*/ 


$(document).ready(function($) {

/*----------------------------------------YDCOZA----------------------------------------*/
/*    Fade Title    */
/*--------------------------------------------------------------------------------------*/

  // Check to see if the window is top if so display title
  $(window).scroll(function(){
    if ($(this).scrollTop() > 70) {
      $('#title h2').addClass('hide');
    } else {
      $('#title h2').removeClass('hide');
    }
  });
  // If Window is not at the top hide title eg. if window is refreshed
  var h2 = $("h2.title");
  var position = h2.position();
    if ( position.top > 250) {
      $('#title h2').addClass('hide');
    }


/*----------------------------------------YDCOZA----------------------------------------*/
/*    fitvids */
/*--------------------------------------------------------------------------------------*/

    $(".sidebar").fitVids();


/*----------------------------------------YDCOZA----------------------------------------*/
/*    Fade in Flex slider images after page load */
/*--------------------------------------------------------------------------------------*/

    jQuery('.flexslider, .testimonial, .minislider').fadeIn(50); 


/*----------------------------------------YDCOZA----------------------------------------*/
/*        Flexslider */
/*--------------------------------------------------------------------------------------*/

  $('.flexslider').flexslider({
    animation: "slide",  
    animationDuration: 300, 
    directionNav: false, 
    controlsContainer: '.flexslider-carousel',
    pauseOnHover: true
  });
  

/*----------------------------------------YDCOZA----------------------------------------*/
/*    To Top */
/*--------------------------------------------------------------------------------------*/

  $().UItoTop({ easingType: 'easeOutQuart' });
  

/*----------------------------------------YDCOZA----------------------------------------*/
/*   Isotope Filter */
/*--------------------------------------------------------------------------------------*/

$(function(){

    var $container = $('#portfolio.sorter'),
        filters = {};

$container.imagesLoaded( function(){ //Solves Chrome images issue

    $container.isotope({
      itemSelector : '.YDCOZA',
      layoutMode : 'fitRows'
    });

    // filter buttons
    $('.filter button').click(function(){
      var $this = $(this);
      // don't proceed if already selected
      if ( $this.hasClass('selected') ) {
        return;
      }

      var $optionSet = $this.parents('.filter');
      // change selected class
      $optionSet.find('.selected').removeClass('selected');
      $this.addClass('selected');

      // store filter value in object
      // i.e. filters.color = 'red'
      var group = $optionSet.attr('data-filter-group');
      filters[ group ] = $this.attr('data-filter-value');
      // convert object into array
      var isoFilters = [];
      for ( var prop in filters ) {
        isoFilters.push( filters[ prop ] )
      }
      var selector = isoFilters.join('');
      $container.isotope({ filter: selector });

      return false;
    });

  });
});

/*----------------------------------------YDCOZA----------------------------------------*/
/*        Prettyphoto */
/*--------------------------------------------------------------------------------------*/
 
    $("a[class^='prettyphoto']").prettyPhoto({opacity:0.80,default_width:200,default_height:344,hideflash:false,modal:false}); 


/*----------------------------------------YDCOZA----------------------------------------*/
/*    Form Validation & Ajax submission */
/*--------------------------------------------------------------------------------------*/

    // validate signup form on keyup and submit
  var validator = $("#contactform").validate({
    rules: {
      contactname: {
        required: true,
        minlength: 5
      },
      email: {
        required: true,
        email: true
      },
      subject: {
        required: true,
        minlength: 2
      },
      message: {
        required: true,
        minlength: 10
      }
    },
    messages: {
      contactname: {
        required: "Please enter your name",
        minlength: jQuery.format("Your name needs to be at least {0} characters")
      },
      email: {
        required: "Please enter a valid email address",
        minlength: "Please enter a valid email address"
      },
      subject: {
        required: "You need to enter a subject!",
        minlength: jQuery.format("Enter at least {0} characters")
      },
      message: {
        required: "You need to enter a message!",
        minlength: jQuery.format("Enter at least {0} characters")
      }
    },
    // set this class to error-labels to indicate valid fields
    success: function(label) {
      label.addClass("checked");
    },

          /*----------------------------------------YDCOZA----------------------------------------*/
          /*    Contact Form Ajax Submit After the form validates we send Ajax call & hide the form section  */
          /*--------------------------------------------------------------------------------------*/
        submitHandler: function() { 

            var url = "includes/send-mail.php"; // the script where you handle the form send.
            $.ajax({
                   type: "POST",
                   url: url,
                   data: $("#contactform").serialize(), // serializes the form's elements.
                   success: function(data){
                     // alert(data); // show response from the send-mail.php.
                      $( '#contactform' ).each(function(){ // Reset the form
                          this.reset();
                      });
                      $('#hide_after').hide(); //hide the Form Section
                      // $('#show_after').show('slow'); //Show Success Message

                      // var content = $( data ).find( '#content' );
                      $( "#result" ).empty().append( data );


                      $(this).hide("slide", { direction: "right" }, 1000);

                   }
                 });
        }


  });


/*----------------------------------------YDCOZA----------------------------------------*/
/*    Testimonials */
/*--------------------------------------------------------------------------------------*/

    $('.testimonial').cycle({
        fx:'fade',
        slideResize: true,
        containerResize: false,
        width: '100%',
        fit: 1,
        speedOut: 50,
        timeout: 6000,
        cleartypeNoBg: true,
        before: onBefore
    });

    function onBefore(curr, next, opts, fwd) { 
        var $ht = $(this).height(); //set the container's height to that of the current slide 
        $(this).parent().animate({height: $ht});
    }

/*----------------------------------------YDCOZA----------------------------------------*/
/*    Tooltip */
/*--------------------------------------------------------------------------------------*/

    $('.price_tooltip').tooltip({ 
      selector:'[data-rel^=tooltip]',
      placement:'bottom'
    });


/*----------------------------------------YDCOZA----------------------------------------*/
/*    Show Drop Down Memu on Hover */
/*--------------------------------------------------------------------------------------*/

  jQuery('ul.nav li.dropdown').hover(function() { 
    jQuery(this).closest('.dropdown-menu').stop(true, true).show(); 
    jQuery(this).addClass('open'); 
  }, 
    function() { 
      jQuery(this).closest('.dropdown-menu').stop(true, true).hide(); 
      jQuery(this).removeClass('open'); 
  });

/*----------------------------------------YDCOZA----------------------------------------*/
/*    backgroundResize */
/*--------------------------------------------------------------------------------------*/


$('.stretch').css( "background-size", "cover" );


}); //Doc Ready