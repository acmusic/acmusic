//Sets the header image height
jQuery(function($) {
	if ( $(window).width() > 1024 ) {
		var height = $(window).height();
		$('.site-header, .overlay').css('height', height);
		$(window).resize(function() {
			var height = $(window).height();
			$('.site-header, .overlay').css('height', height);
		});
	}
	$(window).resize(function(){
		if ($(".header-image").css("display") == "none" ){
			var height = $(window).height();
			$('.site-header, .overlay').css('height', height);
		} else {
			$('.site-header, .overlay').css('height', 'auto');
		}
	});
});

//Page loader
jQuery(document).ready(function($) {
	$("#page").show();
});

//Menu dropdown animation
jQuery(function($) {
	$('.sub-menu').hide();
	$('.main-navigation .children').hide();
	$('.menu-item').hover(
		function() {
			$(this).children('.sub-menu').slideDown();
		},
		function() {
			$(this).children('.sub-menu').hide();
		}
	);
	$('.main-navigation li').hover(
		function() {
			$(this).children('.main-navigation .children').slideDown();
		},
		function() {
			$(this).children('.main-navigation .children').hide();
		}
	);
});

//homepage profile expansion
var active = '';
function slider($, div, num){
	if ($(div).is(':hidden') && (active === '')){
		$(div).slideDown(600);
		fadeInactive($, num);
		// $('span.img-description-wrap.person-' + num).fadeTo(100, 1);
		active = div;
	}
	else if ($(div).is(':hidden') && (div != active)){
		$(active).hide();
		$(div).fadeIn(600);
		fadeInactive($, num);
		// $('span.img-description-wrap.person-' + num).fadeTo(100, 1);
		active = div;
	}
	else {
		$(div).slideUp(600);
		removeInactive($);
		// $('span.img-description-wrap.person-' + num).fadeTo(100, 0);
		active = '';
	}
}

function removeInactive($){
	var x = 1;
	while (x < 8){
		$('img.z.person-' + x).fadeTo(300, 1);
		if (x != active){
			// $('span.img-description-wrap.person-' + x).fadeTo(100, 0);
		}
		x++;
	}
}

function fadeInactive($, num){
	var i = 1;
	removeInactive($);
	while (i < 8){
		if (i != num){
			$("img.z.person-" + i).fadeTo(300, 0.3);
		}
		else{
			// $('span.img-description-wrap.person-' + i).fadeTo(100, 1);
		}
		i++;
	}
}

var activeDesc = '';
function descriptionControl($, num, opacity){
	if (active == ''){
		if(opacity == 1){
			$('span.img-description-wrap.person-' + num).fadeTo(100, opacity);
			activeDesc = num;
			// console.log(activeDesc);
		}
		else if (opacity == 0) {
			$('span.img-description-wrap.person-' + num).fadeTo(100, opacity);
			activeDesc = '';
			// console.log(activeDesc);
		}
	}
	else if (active != '' && activeDesc != active){
		if(opacity == 1 && activeDesc == active){
			$('span.img-description-wrap.person-' + num).fadeTo(100, opacity);
			activeDesc = num;
			// console.log(activeDesc);
		}
		else if(opacity == 0 && activeDesc == active){
			$('span.img-description-wrap.person-' + num).fadeTo(100, opacity);
			activeDesc = '';
			// console.log(activeDesc);
		}
		else if(activeDesc != num){
			$('span.img-description-wrap.person-' + num).fadeTo(100, opacity);
			activeDesc = '';
			// console.log(activeDesc);
		}
	}
	else if (active != '' && activeDesc == active){
		var i = 1;
		if(active == num){
			while (i <= 8) {
				if (i == active){
					$('span.img-description-wrap.person-' + active).fadeTo(100, 1);
				}
				else {
					$('span.img-description-wrap.person-' + i).fadeTo(100, 0);
					i++;
				}
			}
			activeDesc = '';
			// console.log(activeDesc);
		}
	}
}

jQuery(function($){
	$('img.z.person-1').click(
		function () {
			slider($, '.person-bio-1', 1);
		}
	);
	$('img.z.person-2').click(
		function () {
			slider($, '.person-bio-2', 2);
		}
	);
	$('img.z.person-3').click(
		function () {
			slider($, '.person-bio-3', 3);
		}
	);
	$('img.z.person-4').click(
		function () {
			slider($, '.person-bio-4', 4);
		}
	);
	$('img.z.person-5').click(
		function () {
			slider($, '.person-bio-5', 5);
		}
	);
	$('img.z.person-6').click(
		function () {
			slider($, '.person-bio-6', 6);
		}
	);
	$('img.z.person-7').click(
		function () {
			slider($, '.person-bio-7', 7);
		}
	);
	$('img.z.person-8').click(
		function () {
			slider($, '.person-bio-0', 8);
		}
	);
});

jQuery(function($){
	$('div.y.person-1').hover(
		function(){
			descriptionControl($, 1, 1);
			$('img.z.person-1').parent().siblings().stop().fadeTo(300, 0.3);
		},
		function(){
			descriptionControl($, 1, 0);
			$('img.z.person-1').parent().siblings().stop().fadeTo(300, 1);
		}
	)
	$('div.y.person-2').hover(
		function(){
			descriptionControl($, 2, 1);
			$('img.z.person-2').parent().siblings().stop().fadeTo(300, 0.3);
		},
		function(){
			descriptionControl($, 2, 0);
			$('img.z.person-2').parent().siblings().stop().fadeTo(300, 1);
		}
	)
	$('div.y.person-3').hover(
		function(){
			descriptionControl($, 3, 1);
			$('img.z.person-3').parent().siblings().stop().fadeTo(300, 0.3);
		},
		function(){
			descriptionControl($, 3, 0);
			$('img.z.person-3').parent().siblings().stop().fadeTo(300, 1);
		}
	)
	$('div.y.person-4').hover(
		function(){
			descriptionControl($, 4, 1);
			$('img.z.person-4').parent().siblings().stop().fadeTo(300, 0.3);
		},
		function(){
			descriptionControl($, 4, 0);
			$('img.z.person-4').parent().siblings().stop().fadeTo(300, 1);
		}
	)
	$('div.y.person-5').hover(
		function(){
			descriptionControl($, 5, 1);
			$('img.z.person-5').parent().siblings().stop().fadeTo(300, 0.3);
		},
		function(){
			descriptionControl($, 5, 0);
			$('img.z.person-5').parent().siblings().stop().fadeTo(300, 1);
		}
	)
	$('div.y.person-6').hover(
		function(){
			descriptionControl($, 6, 1);
			$('img.z.person-6').parent().siblings().stop().fadeTo(300, 0.3);
		},
		function(){
			descriptionControl($, 6, 0);
			$('img.z.person-6').parent().siblings().stop().fadeTo(300, 1);
		}
	)
	$('div.y.person-7').hover(
		function(){
			descriptionControl($, 7, 1);
			$('img.z.person-7').parent().siblings().stop().fadeTo(300, 0.3);
		},
		function(){
			descriptionControl($, 7, 0);
			$('img.z.person-7').parent().siblings().stop().fadeTo(300, 1);
		}
	)
	$('div.y.person-8').hover(
		function(){
			descriptionControl($, 8, 1);
			$('img.z.person-0').parent().siblings().stop().fadeTo(300, 0.3);
		},
		function(){
			descriptionControl($, 8, 0);
			$('img.z.person-0').parent().siblings().stop().fadeTo(300, 1);
		}
	)
});

//Fit Vids
jQuery(function($) {

  $(document).ready(function(){
    $("body").fitVids();
  });

});

// okvideo
// jQuery(function($) {
// 	$('.okplayer').ready(function(){
// 		$.okvideo({
// 				source: 'https://vimeo.com/110793986',
// 				volume: 0,
// 				hd: true,
// 				onFinished: function(){
// 						console.log('finished video!');
// 				}
// 		});
// 	});
// });

//Sets the img-grid height and width
jQuery(function($) {
	var width = $(window).width();
	$('.z').css('width', width/6 - 0.05);
	$('.z').css('height', width/6 - 0.05);
	$(window).resize(function() {
		var width = $(window).width();
		$('.z').css('width', width/6 - 0.05);
		$('.z').css('height', width/6 - 0.05);
	});
});

//Waypoints
jQuery(function($) {
	$('.fact').waypoint(function(down) {
		$('.fact').each(function () {
			var $this = $(this);
			$({ Counter: 0 }).animate({ Counter: $this.attr('id') }, {
				duration: 1000,
				easing: 'swing',
				step: function () {
				    $this.text(Math.ceil(this.Counter));
				}
			});
		});
	},
	{
	  offset: '90%',
	  triggerOnce: true
	});
	$('.skill-bar').waypoint(function(down) {
		$('.skill-bar').each(function() {
			var bar = $(this);
			var max = $(this).attr('id');
			var progressBarWidth = max * bar.width() / 100;
			bar.find('div').animate({ width: progressBarWidth }, 1000).html(max + "%&nbsp;");
		});
	},
	{
	  offset: '90%',
	  triggerOnce: true
	});
});

//Make the menu sticky
jQuery(function($) {
	$(window).bind("load", function() {
		$(".top-bar").sticky();
	});
});

//Better support for third party widgets
jQuery(function($) {
    $('.so-panel.widget, .panel.widget').addClass('container');
});

//Open social links in a new tab
jQuery(function($) {
     $( '.social-area li a, .social-widget a' ).attr( 'target','_blank' );
});

//Smooth scrolling
jQuery(function($) {
	$('a[href*=#]:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			var topbar = $('.top-bar').height();
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if ( this.hash != '#site-navigation' && $(window).width() > 1024 ) {
				if (target.length) {
				$('html,body').animate({
				scrollTop: target.offset().top - topbar + 40
				}, 800);
				return false;
				}
			} else {
				if (target.length) {
				$('html,body').animate({
				scrollTop: target.offset().top
				}, 800);
				return false;
				}
			}
		}
	});
});

function checkFired($, fired){
	if (!fired){
		$('div.member-letter-group').css('display', 'none');
		fired = true;
		return true;
	}
	else {
		return true;
	}
}

// active = all from the beginning will help
jQuery(function($) {
	var fired = false;
	var active = '';
	$('.scrollto').click(function() {
		var selection = ($(this).text()).toLowerCase();
		var target = '.member-' + selection + '-object';
		var listTarget = '.member-list-' + selection;
		fired = checkFired($, fired);
		if (active == '' && selection != 'all') {
			$(target).css('display', 'block');
			$(listTarget).addClass('active-list-letter');
			active = selection;
		}
		else if (active == '' && selection == 'all') {
			$('div.member-letter-group').css('display', 'block');
			$(listTarget).addClass('active-list-letter');
			active = 'all';
		}
		else if (active == 'all' && selection == 'all'){
			$('div.member-letter-group').css('display', 'block');
			$(listTarget).addClass('active-list-letter');
			active = 'all';
		}
		else if (active != '' && active != 'all' && selection == 'all'){
			$('.member-' + active + '-object').css('display', 'none');
			$('div.member-letter-group').css('display', 'block');
			$('.member-list-' + active).removeClass('active-list-letter');
			$(listTarget).addClass('active-list-letter');
			active = 'all';
		}
		else if (active != '' && active != target) {
			$('div.member-letter-group').css('display', 'none');
			$('.member-list-' + active).removeClass('active-list-letter');

			$(listTarget).addClass('active-list-letter');
			$('.member-' + active + '-object').css('display', 'none');
			$(target).css('display', 'block');
			active = selection;
		}

	});
});

//Search form
jQuery(function($) {
	$('.nav-search').click(function() {
		$('.nav-search-box').addClass('search-visible');
	});
	$('.search-close').click(function() {
		$('.nav-search-box').removeClass('search-visible');
	});
});

// welcome buttons
jQuery(function($) {
	var action = function($){
		$('.button-1').css('display', 'inline-block');
		setTimeout(function(){$('.button-1').css('display', 'none'); $('.button-2').css('display', 'inline-block');}, 10000);
		setTimeout(function(){$('.button-2').css('display', 'none'); $('.button-3').css('display', 'inline-block');}, 20000);
		setTimeout(function(){$('.button-3').css('display', 'none'); $('.button-4').css('display', 'inline-block');}, 30000);
		setTimeout(function(){$('.button-4').css('display', 'none'); $('.button-5').css('display', 'inline-block');}, 40000);
		setTimeout(function(){$('.button-5').css('display', 'none'); action($); }, 50000);
	}
	action($);


});

// google.setOnLoadCallback(drawRegionsMap);
//
// function drawRegionsMap() {
//
// 	var data = google.visualization.arrayToDataTable([
// 		['Country', 'Composers'],
// 		['Germany', 200],
// 		['United States', 300],
// 		['Brazil', 400],
// 		['Canada', 500],
// 		['France', 600],
// 		['RU', 700]
// 	]);
//
// 	var options = {legend: 'none'};
//
// 	var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
//
// 	chart.draw(data, options);
// }

function sortCount(arr) {
    var a = [], b = [], prev;

    arr.sort();
    for ( var i = 0; i < arr.length; i++ ) {
        if ( arr[i] !== prev ) {
            a.push(arr[i]);
            b.push(1);
        } else {
            b[b.length-1]++;
        }
        prev = arr[i];
    }

		var result = [];
		result[0] = ['Country', 'Composers'];
		for(var i = 1; i < a.length+1; i++){
			result[i] = [a[i],b[i]];
		}

		return result;
}

function hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}
