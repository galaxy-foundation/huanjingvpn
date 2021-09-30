/*
Template Name: Soft Themez - Software Landing Page Template
Author: Askbootstrap
Author URI: https://themeforest.net/user/askbootstrap
Version: 1.0
*/
$(document).ready(function() {
"use strict";

// ===========Navbar============
$('.navbar-nav li.dropdown').hover(function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(500);
}, function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(500);
});

// ===========Navbar Scroll============
$(window).scroll(function() {
    var scroll = $(window).scrollTop();

    if (scroll >= 100) {
        $(".navbar").addClass("fixed-navbar inner-navbar fixed-top");
    } else {
        $(".navbar").removeClass("fixed-navbar inner-navbar fixed-top");
    }
});

// ===========Screens============
var screensslider = $(".screens");
if (screensslider) {
    screensslider.owlCarousel({
        center: true,
        items: 2,
        loop: true,
        navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],


        responsive: {
            0: {
                items: 1,
                nav: true
            },
            800: {
                items: 2,
                nav: true
            },
        }
    });
}

// ===========Blogs Slider============
var blogslider = $(".blogs-slider");
if (blogslider.length > 0) {
    blogslider.owlCarousel({
        items: 3,


        responsive: {
            0: {
                items: 1,
                nav: false
            },
            800: {
                items: 3,
                nav: false
            },
        }
    });
}

// ===========wow============
new WOW().init();	

});