import 'bootstrap';
import 'selectize';
import fitvids from 'fitvids';
import 'jquery-ui/slider';
import './jquery.nicescroll.js';
import './jquery.sticky.js';
import './jquery.counterup.js';
import './jquery.inview.js';
import './daterangepicker.js';
import './owl.carousel.js';

var $ = jQuery;
// Progress bar
;(function($) {
  'use strict';

  $('.btn-group .dropdown-menu').on('click', function (e) {
    e.stopPropagation();
  });

  $(window).load(function() {
    $("#fakeloader").fadeOut("slow");
  });
  // counter
  $('.count-result').countTo();
  $('.fact-box-count').countTo();
  // progres bar
  $('.progress-bar.one').on('inview', function(event, isInView) {
    if (isInView) {
      $(this).css({ 'width': '70%'});
    } else {
      $(this).css({'width': '0%'});
    }
  });
  $('.progress-bar.two').on('inview', function(event, isInView) {
    if (isInView) {
      $(this).css({ 'width': '95%'});
    } else {
      $(this).css({'width': '0%'});
    }
  });

  $('.progress-bar.three').on('inview', function(event, isInView) {
    if (isInView) {
      $(this).css({ 'width': '50%'});
    } else {
      $(this).css({'width': '0%'});
    }
  });

  // Sticky header
  $("#sticker").sticky({topSpacing:0});
  $("#elements-menu").sticky({topSpacing:120});

  $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll >= 20) {
      $(".home-two-nav").addClass("nav-two-bg");
    }
    if (scroll === 0) {
      $(".home-two-nav").removeClass("nav-two-bg");
    }
  });

  $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll >= 20) {
      $(".single-post-nav").addClass("nav-two-bg");
    }
    if (scroll === 0) {
      $(".single-post-nav").removeClass("nav-two-bg");
    }
  });

  // Elements page sidevar menu sticky
  $(window).scroll(function() {
    if ($(this).scrollTop() > ( $(document).height() - $( ".rq-footer" ).height() - $(window).height()  ) ) {
      $("#elements-menu").css('visibility', 'hidden');
    } else{
      $("#elements-menu").css('visibility', 'visible');
    }
  });

  // Footer toggle widget
  $(".toggle-widget").on('click', function(){
    $(".footer-widget").slideToggle(300);
    $(this).toggleClass('active');
  });
  // Range sdlier jquery ui
  $( "#slider-range" ).slider({
    range: true,
    min: 0,
    max: 500,
    values: [ 75, 300 ],
    slide: function( event, ui ) {
      $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
    }
  });
  $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
                     " - $" + $( "#slider-range" ).slider( "values", 1 ) );

  // Nice scroll plugin customizatin
  $(".table-responsive").niceScroll({
    scrollspeed: 10,
    mousescrollstep: 100,
    autohidemode: false,
    cursorcolor: "#0a252e",
    background: "#efeeee",
    cursorborderradius: 0,
    cursorborder: 0,
  });

  $(".child-tab-wrapper .nav-tabs").niceScroll({
    scrollspeed: 10,
    mousescrollstep: 100,
    autohidemode: true,
    cursorcolor: "#0a252e",
    background: "#efeeee",
    cursorborderradius: 0,
    cursorborder: 0,
  });

  // Custom select box
  $('.rq-search-content select').selectize();

  $('.rq-cart-options-content select').selectize();

})(jQuery);


;(function($) {
  'use strict';
  // faq accordion
  const faqHidden = $('.faq-single .hidden-content').hide();
  $('.faq-single').on('click', 'a.faq-title', function(e) {
    e.preventDefault();
    const item = $(this);
    const row = item.next('p.hidden-content');
    const contentHide = $('p.hidden-content');
    const titleHide = $('a.faq-title');

    if (item.hasClass('active') !== false) {
      contentHide.slideUp();
      item.removeClass( 'active' );
    } else {
      titleHide.removeClass( 'active' );
      item.toggleClass( 'active' );
      contentHide.slideUp();
      row.slideToggle();
    }
  });
  // Grid list view option change
  $('.rq-grid-list-view-option').on('click', 'a', function (e) {
    e.preventDefault();
    const item = $(this);
    const dataClass = item.data('class');
    item.siblings().removeClass('active');
    const row = $('.rq-listing-choose');

    if (dataClass === 'rq-listing-list') {
      row.removeClass('rq-listing-grid').addClass(dataClass);
    } else {
      row.removeClass('rq-listing-list').addClass(dataClass);
    }
    item.addClass('active');
  });
  // date range picker
  $('input#enddate').on( 'click', function(){
    $('input#startdate').trigger('click');
  });
  $('input#startdate').daterangepicker({
    autoUpdateInput: false,
    minDate: new Date(),
    locale: {
      cancelLabel: 'Clear'
    }
  });
  $('input#startdate').on('apply.daterangepicker', function(ev, picker) {
    $('#startdate').val(picker.startDate.format('MM/DD/YYYY'));
  });
  $('input#startdate').on('apply.daterangepicker', function(ev, picker){
    $('#enddate').val(picker.endDate.format('MM/DD/YYYY'));
  });

  $('input#startdate').on('cancel.daterangepicker', function(ev, picker) {
    $('input#startdate').val('');
    $('input#enddate').val('');
  });
})(jQuery);


;(function($) {
  'use strict';
  // owl carousel
  jQuery('.owl-loop').owlCarousel({
    center: true,
    items:1,
    loop:true,
    nav:true,
    navText:['&#xf3d2;','&#xf3d3;'],
    margin:20,
    responsive:{
      600:{
        items:1
      },
      1000: {
        items: 3
      },
      1400: {
        items: 5
      }
    }
  });

  jQuery('.details-slider').owlCarousel({
    center: true,
    items:1,
    loop:true,
    nav:true,
    navText:['&#xf3d2','&#xf3d3;'],

  });

  jQuery('.testimonial-wrapper').owlCarousel({
    center: true,
    items:1,
    loop:true,
    nav:false,
    navText:['&#xf3d2;','&#xf3d3;'],
    margin:20,
  });

  // responsive video
  fitvids('.fitvids-wrapper');
})(jQuery);




