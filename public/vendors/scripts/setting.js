/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 171);
/******/ })
/************************************************************************/
/******/ ({

/***/ 171:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(172);


/***/ }),

/***/ 172:
/***/ (function(module, exports) {

jQuery(window).on("load", function () {
	"use strict";

	jQuery(".pre-loader").fadeToggle("medium");
	// bootstrap wysihtml5
	$('.textarea_editor').wysihtml5({
		html: true
	});
});
// jQuery(window).on("load resize", function () {
// 	$(".customscroll").mCustomScrollbar({
// 		theme: "minimal-dark",
// 		advanced:{
// 			autoScrollOnFocus: false,
// 		},
// 	});
// });
jQuery(document).ready(function () {
	"use strict";
	// Background Image

	jQuery(".bg_img").each(function (i, elem) {
		var img = jQuery(elem);
		jQuery(this).hide();
		jQuery(this).parent().css({
			background: "url(" + img.attr("src") + ") no-repeat center center"
		});
	});

	// click to scroll
	// $('.collapse-box').on('shown.bs.collapse', function () {
	// 	$(".customscroll").mCustomScrollbar("scrollTo",$(this));
	// });

	// code split
	var entityMap = {
		"&": "&amp;",
		"<": "&lt;",
		">": "&gt;",
		'"': '&quot;',
		"'": '&#39;',
		"/": '&#x2F;'
	};
	function escapeHtml(string) {
		return String(string).replace(/[&<>"'\/]/g, function (s) {
			return entityMap[s];
		});
	}
	//document.addEventListener("DOMContentLoaded", init, false);
	window.onload = function init() {
		var codeblock = document.querySelectorAll("pre code");
		if (codeblock.length) {
			for (var i = 0, len = codeblock.length; i < len; i++) {
				var dom = codeblock[i];
				var html = dom.innerHTML;
				html = escapeHtml(html);
				dom.innerHTML = html;
			}
			$('pre code').each(function (i, block) {
				hljs.highlightBlock(block);
			});
		}
	};
	// custom select 2 init
	$('.custom-select2').select2();

	// Bootstrap Select
	$('.selectpicker').selectpicker();

	// tooltip init
	$('[data-toggle="tooltip"]').tooltip();

	// popover init
	$('[data-toggle="popover"]').popover();

	// form-control on focus add class
	$(".form-control").on('focus', function () {
		$(this).parent().addClass("focus");
	});
	$(".form-control").on('focusout', function () {
		$(this).parent().removeClass("focus");
	});

	// Dropdown Slide Animation
	$('.dropdown').on('show.bs.dropdown', function (e) {
		$(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
	});
	$('.dropdown').on('hide.bs.dropdown', function (e) {
		$(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
	});

	// sidebar menu icon
	$('.menu-icon').on('click', function () {
		$(this).toggleClass('open');
		$('.left-side-bar').toggleClass('open');
	});

	var w = $(window).width();
	$(document).on('touchstart click', function (e) {
		if ($(e.target).parents('.left-side-bar').length == 0 && !$(e.target).is('.menu-icon, .menu-icon span')) {
			$('.left-side-bar').removeClass('open');
			$('.menu-icon').removeClass('open');
		};
	});
	$(window).on('resize', function () {
		var w = $(window).width();
		if ($(window).width() > 1200) {
			$('.left-side-bar').removeClass('open');
			$('.menu-icon').removeClass('open');
		}
	});

	// sidebar menu Active Class
	$('#accordion-menu').each(function () {
		var vars = window.location.href.split("/").pop();
		$(this).find('a[href="' + vars + '"]').addClass('active');
	});

	// click to copy icon
	$(".fa-hover").click(function (event) {
		event.preventDefault();
		var $html = $(this).find('.icon-copy').first();
		var str = $html.prop('outerHTML');
		CopyToClipboard(str, true, "Copied");
	});
	// var clipboard = new ClipboardJS('.code-copy');
	// clipboard.on('success', function(e) {
	// 	CopyToClipboard('',true, "Copied");
	// 	e.clearSelection();
	// });

	// date picker
	$('.date-picker').datepicker({
		language: 'en',
		autoClose: true,
		dateFormat: 'dd MM yyyy'
	});
	$('.datetimepicker').datepicker({
		timepicker: true,
		language: 'en',
		autoClose: true,
		dateFormat: 'dd MM yyyy'
	});
	$('.datetimepicker-range').datepicker({
		language: 'en',
		range: true,
		multipleDates: true,
		multipleDatesSeparator: " - "
	});
	$('.month-picker').datepicker({
		language: 'en',
		minView: 'months',
		view: 'months',
		autoClose: true,
		dateFormat: 'MM yyyy'
	});

	// only time picker
	$(".time-picker").timeDropper({
		mousewheel: true,
		meridians: true,
		init_animation: 'dropdown',
		setCurrentTime: false
	});
	$('.time-picker-default').timeDropper();

	// var color = $('.btn').data('color');
	// console.log(color);
	// $('.btn').style('color'+color);
	$("[data-color]").each(function () {
		$(this).css('color', $(this).attr('data-color'));
	});
	$("[data-bgcolor]").each(function () {
		$(this).css('background-color', $(this).attr('data-bgcolor'));
	});
	$("[data-border]").each(function () {
		$(this).css('border', $(this).attr('data-border'));
	});

	$("#accordion-menu").vmenuModule({
		Speed: 400,
		autostart: false,
		autohide: true
	});
});

// sidebar menu accordion
(function ($) {
	$.fn.vmenuModule = function (option) {
		var obj, item;
		var options = $.extend({
			Speed: 220,
			autostart: true,
			autohide: 1
		}, option);
		obj = $(this);

		item = obj.find("ul").parent("li").children("a");
		item.attr("data-option", "off");

		item.unbind('click').on("click", function () {
			var a = $(this);
			if (options.autohide) {
				a.parent().parent().find("a[data-option='on']").parent("li").children("ul").slideUp(options.Speed / 1.2, function () {
					$(this).parent("li").children("a").attr("data-option", "off");
					$(this).parent("li").removeClass("show");
				});
			}
			if (a.attr("data-option") == "off") {
				a.parent("li").children("ul").slideDown(options.Speed, function () {
					a.attr("data-option", "on");
					a.parent('li').addClass("show");
				});
			}
			if (a.attr("data-option") == "on") {
				a.attr("data-option", "off");
				a.parent("li").children("ul").slideUp(options.Speed);
				a.parent('li').removeClass("show");
			}
		});
		if (options.autostart) {
			obj.find("a").each(function () {

				$(this).parent("li").parent("ul").slideDown(options.Speed, function () {
					$(this).parent("li").children("a").attr("data-option", "on");
				});
			});
		} else {
			obj.find("a.active").each(function () {

				$(this).parent("li").parent("ul").slideDown(options.Speed, function () {
					$(this).parent("li").children("a").attr("data-option", "on");
					$(this).parent('li').addClass("show");
				});
			});
		}
	};
})(window.jQuery || window.Zepto);

function CopyToClipboard(value, showNotification, notificationText) {
	var $temp = $("<input>");
	if (value != '') {
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val(value).select();
		document.execCommand("copy");
		$temp.remove();
	}
	if (typeof showNotification === 'undefined') {
		showNotification = true;
	}
	if (typeof notificationText === 'undefined') {
		notificationText = "Copied to clipboard";
	}
	var notificationTag = $("div.copy-notification");
	if (showNotification && notificationTag.length == 0) {
		notificationTag = $("<div/>", { "class": "copy-notification", text: notificationText });
		$("body").append(notificationTag);

		notificationTag.fadeIn("slow", function () {
			setTimeout(function () {
				notificationTag.fadeOut("slow", function () {
					notificationTag.remove();
				});
			}, 1000);
		});
	}
}

/***/ })

/******/ });