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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/assets/js/customize-preview.js":
/*!********************************************!*\
  !*** ./src/assets/js/customize-preview.js ***!
  \********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _helpers_strip_tags__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./helpers/strip-tags */ "./src/assets/js/helpers/strip-tags.js");

 // console.log(wp)

console.log(_themename); //live update blog title

wp.customize('blogname', function (value) {
  value.bind(function (to) {
    jquery__WEBPACK_IMPORTED_MODULE_0___default()('.c-header__blogname').html(to);
  });
});
wp.customize('_themename_accent_colour', function (value) {
  value.bind(function (to) {
    // $('#_themename-stylesheet-inline-css').html(
    //   `
    //     a {
    //       color: ${to}
    //     }
    //     :focus{
    //       outline-color: ${to}
    //     }
    //     .c-post.sticky{
    //       border-left-color: ${to}
    //     }
    //     'button, input[type=submit], .header-nav .menu > .menu-item:not(.mega) .sub-menu .menu-item:hover > a {
    //       background-color: ${to}
    //     }
    //   `
    // )
    var inline_css = "";
    var inline_css_obj = _themename['inline-css'];

    for (var selector in inline_css_obj) {
      inline_css += "".concat(selector, " {");

      for (var prop in inline_css_obj[selector]) {
        var val = inline_css_obj[selector][prop]; // get any setting by its name (val) from wp database

        inline_css += "".concat(prop, ": ").concat(wp.customize(val).get());
      }

      inline_css += "}";
    }

    jquery__WEBPACK_IMPORTED_MODULE_0___default()('#_themename-stylesheet-inline-css').html(inline_css);
  });
});
wp.customize('_themename_site_info', function (value) {
  //bind means we are now listening to the change events to the input for site_info setting
  value.bind(function (to) {
    //to is now the input, updated every time something is typed
    //console.log(to);
    jquery__WEBPACK_IMPORTED_MODULE_0___default()('.c-site-info__text').html(Object(_helpers_strip_tags__WEBPACK_IMPORTED_MODULE_1__["default"])(to, '<a>'));
  });
});

/***/ }),

/***/ "./src/assets/js/helpers/strip-tags.js":
/*!*********************************************!*\
  !*** ./src/assets/js/helpers/strip-tags.js ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//strips all tags, apart from allowed tags
var strip_tags = function strip_tags(input, allowed) {
  allowed = (((allowed || '') + '').toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)

  var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
      commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
  return input.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
    return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
  });
};

/* harmony default export */ __webpack_exports__["default"] = (strip_tags);

/***/ }),

/***/ 3:
/*!**************************************************!*\
  !*** multi ./src/assets/js/customize-preview.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/bubdrops/wp-content/themes/_themename/src/assets/js/customize-preview.js */"./src/assets/js/customize-preview.js");


/***/ }),

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = jQuery;

/***/ })

/******/ });
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAiLCJ3ZWJwYWNrOi8vLy4vc3JjL2Fzc2V0cy9qcy9jdXN0b21pemUtcHJldmlldy5qcyIsIndlYnBhY2s6Ly8vLi9zcmMvYXNzZXRzL2pzL2hlbHBlcnMvc3RyaXAtdGFncy5qcyIsIndlYnBhY2s6Ly8vZXh0ZXJuYWwgXCJqUXVlcnlcIiJdLCJuYW1lcyI6WyJjb25zb2xlIiwibG9nIiwiX3RoZW1lbmFtZSIsIndwIiwiY3VzdG9taXplIiwidmFsdWUiLCJiaW5kIiwidG8iLCIkIiwiaHRtbCIsImlubGluZV9jc3MiLCJpbmxpbmVfY3NzX29iaiIsInNlbGVjdG9yIiwicHJvcCIsInZhbCIsImdldCIsInN0cmlwX3RhZ3MiLCJpbnB1dCIsImFsbG93ZWQiLCJ0b0xvd2VyQ2FzZSIsIm1hdGNoIiwiam9pbiIsInRhZ3MiLCJjb21tZW50c0FuZFBocFRhZ3MiLCJyZXBsYWNlIiwiJDAiLCIkMSIsImluZGV4T2YiXSwibWFwcGluZ3MiOiI7UUFBQTtRQUNBOztRQUVBO1FBQ0E7O1FBRUE7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7O1FBRUE7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7UUFDQTs7O1FBR0E7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7UUFDQTtRQUNBLDBDQUEwQyxnQ0FBZ0M7UUFDMUU7UUFDQTs7UUFFQTtRQUNBO1FBQ0E7UUFDQSx3REFBd0Qsa0JBQWtCO1FBQzFFO1FBQ0EsaURBQWlELGNBQWM7UUFDL0Q7O1FBRUE7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBLHlDQUF5QyxpQ0FBaUM7UUFDMUUsZ0hBQWdILG1CQUFtQixFQUFFO1FBQ3JJO1FBQ0E7O1FBRUE7UUFDQTtRQUNBO1FBQ0EsMkJBQTJCLDBCQUEwQixFQUFFO1FBQ3ZELGlDQUFpQyxlQUFlO1FBQ2hEO1FBQ0E7UUFDQTs7UUFFQTtRQUNBLHNEQUFzRCwrREFBK0Q7O1FBRXJIO1FBQ0E7OztRQUdBO1FBQ0E7Ozs7Ozs7Ozs7Ozs7QUNsRkE7QUFBQTtBQUFBO0FBQUE7QUFBQTtDQUdBOztBQUNBQSxPQUFPLENBQUNDLEdBQVIsQ0FBWUMsVUFBWixFLENBRUE7O0FBQ0FDLEVBQUUsQ0FBQ0MsU0FBSCxDQUFjLFVBQWQsRUFBMEIsVUFBQ0MsS0FBRCxFQUFXO0FBQ25DQSxPQUFLLENBQUNDLElBQU4sQ0FBWSxVQUFDQyxFQUFELEVBQVE7QUFDaEJDLGlEQUFDLENBQUMscUJBQUQsQ0FBRCxDQUF5QkMsSUFBekIsQ0FBOEJGLEVBQTlCO0FBQ0gsR0FGRDtBQUdELENBSkQ7QUFNQUosRUFBRSxDQUFDQyxTQUFILENBQWMsMEJBQWQsRUFBMEMsVUFBQ0MsS0FBRCxFQUFXO0FBQ25EQSxPQUFLLENBQUNDLElBQU4sQ0FBWSxVQUFDQyxFQUFELEVBQVE7QUFDbEI7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQSxRQUFJRyxVQUFVLEtBQWQ7QUFDQSxRQUFJQyxjQUFjLEdBQUdULFVBQVUsQ0FBQyxZQUFELENBQS9COztBQUNBLFNBQUksSUFBSVUsUUFBUixJQUFvQkQsY0FBcEIsRUFBb0M7QUFDaENELGdCQUFVLGNBQU9FLFFBQVAsT0FBVjs7QUFDSSxXQUFJLElBQUlDLElBQVIsSUFBZ0JGLGNBQWMsQ0FBQ0MsUUFBRCxDQUE5QixFQUEwQztBQUN0QyxZQUFJRSxHQUFHLEdBQUdILGNBQWMsQ0FBQ0MsUUFBRCxDQUFkLENBQXlCQyxJQUF6QixDQUFWLENBRHNDLENBRXRDOztBQUNBSCxrQkFBVSxjQUFPRyxJQUFQLGVBQWdCVixFQUFFLENBQUNDLFNBQUgsQ0FBYVUsR0FBYixFQUFrQkMsR0FBbEIsRUFBaEIsQ0FBVjtBQUNIOztBQUNMTCxnQkFBVSxPQUFWO0FBQ0g7O0FBQ0RGLGlEQUFDLENBQUMsbUNBQUQsQ0FBRCxDQUF1Q0MsSUFBdkMsQ0FBNENDLFVBQTVDO0FBQ0QsR0E5QkQ7QUErQkQsQ0FoQ0Q7QUFrQ0FQLEVBQUUsQ0FBQ0MsU0FBSCxDQUFjLHNCQUFkLEVBQXNDLFVBQUNDLEtBQUQsRUFBVTtBQUM5QztBQUNBQSxPQUFLLENBQUNDLElBQU4sQ0FBVyxVQUFDQyxFQUFELEVBQVE7QUFDakI7QUFDQTtBQUNBQyxpREFBQyxDQUFDLG9CQUFELENBQUQsQ0FBd0JDLElBQXhCLENBQTZCTyxtRUFBVSxDQUFDVCxFQUFELEVBQUssS0FBTCxDQUF2QztBQUNELEdBSkQ7QUFLRCxDQVBELEU7Ozs7Ozs7Ozs7OztBQy9DQTtBQUFBO0FBQ0EsSUFBTVMsVUFBVSxHQUFHLFNBQWJBLFVBQWEsQ0FBQ0MsS0FBRCxFQUFRQyxPQUFSLEVBQW9CO0FBQ3JDQSxTQUFPLEdBQUcsQ0FBQyxDQUFDLENBQUNBLE9BQU8sSUFBSSxFQUFaLElBQWtCLEVBQW5CLEVBQ1ZDLFdBRFUsR0FFVkMsS0FGVSxDQUVKLG1CQUZJLEtBRW9CLEVBRnJCLEVBR1RDLElBSFMsQ0FHSixFQUhJLENBQVYsQ0FEcUMsQ0FJMUI7O0FBQ1gsTUFBSUMsSUFBSSxHQUFHLGdDQUFYO0FBQUEsTUFDQUMsa0JBQWtCLEdBQUcsMENBRHJCO0FBRUEsU0FBT04sS0FBSyxDQUFDTyxPQUFOLENBQWNELGtCQUFkLEVBQWtDLEVBQWxDLEVBQ05DLE9BRE0sQ0FDRUYsSUFERixFQUNRLFVBQVNHLEVBQVQsRUFBYUMsRUFBYixFQUFpQjtBQUM5QixXQUFPUixPQUFPLENBQUNTLE9BQVIsQ0FBZ0IsTUFBTUQsRUFBRSxDQUFDUCxXQUFILEVBQU4sR0FBeUIsR0FBekMsSUFBZ0QsQ0FBQyxDQUFqRCxHQUFxRE0sRUFBckQsR0FBMEQsRUFBakU7QUFDRCxHQUhNLENBQVA7QUFJRCxDQVhEOztBQWFlVCx5RUFBZixFOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQ2RBLHdCIiwiZmlsZSI6ImN1c3RvbWl6ZS1wcmV2aWV3LmpzIiwic291cmNlc0NvbnRlbnQiOlsiIFx0Ly8gVGhlIG1vZHVsZSBjYWNoZVxuIFx0dmFyIGluc3RhbGxlZE1vZHVsZXMgPSB7fTtcblxuIFx0Ly8gVGhlIHJlcXVpcmUgZnVuY3Rpb25cbiBcdGZ1bmN0aW9uIF9fd2VicGFja19yZXF1aXJlX18obW9kdWxlSWQpIHtcblxuIFx0XHQvLyBDaGVjayBpZiBtb2R1bGUgaXMgaW4gY2FjaGVcbiBcdFx0aWYoaW5zdGFsbGVkTW9kdWxlc1ttb2R1bGVJZF0pIHtcbiBcdFx0XHRyZXR1cm4gaW5zdGFsbGVkTW9kdWxlc1ttb2R1bGVJZF0uZXhwb3J0cztcbiBcdFx0fVxuIFx0XHQvLyBDcmVhdGUgYSBuZXcgbW9kdWxlIChhbmQgcHV0IGl0IGludG8gdGhlIGNhY2hlKVxuIFx0XHR2YXIgbW9kdWxlID0gaW5zdGFsbGVkTW9kdWxlc1ttb2R1bGVJZF0gPSB7XG4gXHRcdFx0aTogbW9kdWxlSWQsXG4gXHRcdFx0bDogZmFsc2UsXG4gXHRcdFx0ZXhwb3J0czoge31cbiBcdFx0fTtcblxuIFx0XHQvLyBFeGVjdXRlIHRoZSBtb2R1bGUgZnVuY3Rpb25cbiBcdFx0bW9kdWxlc1ttb2R1bGVJZF0uY2FsbChtb2R1bGUuZXhwb3J0cywgbW9kdWxlLCBtb2R1bGUuZXhwb3J0cywgX193ZWJwYWNrX3JlcXVpcmVfXyk7XG5cbiBcdFx0Ly8gRmxhZyB0aGUgbW9kdWxlIGFzIGxvYWRlZFxuIFx0XHRtb2R1bGUubCA9IHRydWU7XG5cbiBcdFx0Ly8gUmV0dXJuIHRoZSBleHBvcnRzIG9mIHRoZSBtb2R1bGVcbiBcdFx0cmV0dXJuIG1vZHVsZS5leHBvcnRzO1xuIFx0fVxuXG5cbiBcdC8vIGV4cG9zZSB0aGUgbW9kdWxlcyBvYmplY3QgKF9fd2VicGFja19tb2R1bGVzX18pXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm0gPSBtb2R1bGVzO1xuXG4gXHQvLyBleHBvc2UgdGhlIG1vZHVsZSBjYWNoZVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5jID0gaW5zdGFsbGVkTW9kdWxlcztcblxuIFx0Ly8gZGVmaW5lIGdldHRlciBmdW5jdGlvbiBmb3IgaGFybW9ueSBleHBvcnRzXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLmQgPSBmdW5jdGlvbihleHBvcnRzLCBuYW1lLCBnZXR0ZXIpIHtcbiBcdFx0aWYoIV9fd2VicGFja19yZXF1aXJlX18ubyhleHBvcnRzLCBuYW1lKSkge1xuIFx0XHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCBuYW1lLCB7IGVudW1lcmFibGU6IHRydWUsIGdldDogZ2V0dGVyIH0pO1xuIFx0XHR9XG4gXHR9O1xuXG4gXHQvLyBkZWZpbmUgX19lc01vZHVsZSBvbiBleHBvcnRzXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnIgPSBmdW5jdGlvbihleHBvcnRzKSB7XG4gXHRcdGlmKHR5cGVvZiBTeW1ib2wgIT09ICd1bmRlZmluZWQnICYmIFN5bWJvbC50b1N0cmluZ1RhZykge1xuIFx0XHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCBTeW1ib2wudG9TdHJpbmdUYWcsIHsgdmFsdWU6ICdNb2R1bGUnIH0pO1xuIFx0XHR9XG4gXHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCAnX19lc01vZHVsZScsIHsgdmFsdWU6IHRydWUgfSk7XG4gXHR9O1xuXG4gXHQvLyBjcmVhdGUgYSBmYWtlIG5hbWVzcGFjZSBvYmplY3RcbiBcdC8vIG1vZGUgJiAxOiB2YWx1ZSBpcyBhIG1vZHVsZSBpZCwgcmVxdWlyZSBpdFxuIFx0Ly8gbW9kZSAmIDI6IG1lcmdlIGFsbCBwcm9wZXJ0aWVzIG9mIHZhbHVlIGludG8gdGhlIG5zXG4gXHQvLyBtb2RlICYgNDogcmV0dXJuIHZhbHVlIHdoZW4gYWxyZWFkeSBucyBvYmplY3RcbiBcdC8vIG1vZGUgJiA4fDE6IGJlaGF2ZSBsaWtlIHJlcXVpcmVcbiBcdF9fd2VicGFja19yZXF1aXJlX18udCA9IGZ1bmN0aW9uKHZhbHVlLCBtb2RlKSB7XG4gXHRcdGlmKG1vZGUgJiAxKSB2YWx1ZSA9IF9fd2VicGFja19yZXF1aXJlX18odmFsdWUpO1xuIFx0XHRpZihtb2RlICYgOCkgcmV0dXJuIHZhbHVlO1xuIFx0XHRpZigobW9kZSAmIDQpICYmIHR5cGVvZiB2YWx1ZSA9PT0gJ29iamVjdCcgJiYgdmFsdWUgJiYgdmFsdWUuX19lc01vZHVsZSkgcmV0dXJuIHZhbHVlO1xuIFx0XHR2YXIgbnMgPSBPYmplY3QuY3JlYXRlKG51bGwpO1xuIFx0XHRfX3dlYnBhY2tfcmVxdWlyZV9fLnIobnMpO1xuIFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkobnMsICdkZWZhdWx0JywgeyBlbnVtZXJhYmxlOiB0cnVlLCB2YWx1ZTogdmFsdWUgfSk7XG4gXHRcdGlmKG1vZGUgJiAyICYmIHR5cGVvZiB2YWx1ZSAhPSAnc3RyaW5nJykgZm9yKHZhciBrZXkgaW4gdmFsdWUpIF9fd2VicGFja19yZXF1aXJlX18uZChucywga2V5LCBmdW5jdGlvbihrZXkpIHsgcmV0dXJuIHZhbHVlW2tleV07IH0uYmluZChudWxsLCBrZXkpKTtcbiBcdFx0cmV0dXJuIG5zO1xuIFx0fTtcblxuIFx0Ly8gZ2V0RGVmYXVsdEV4cG9ydCBmdW5jdGlvbiBmb3IgY29tcGF0aWJpbGl0eSB3aXRoIG5vbi1oYXJtb255IG1vZHVsZXNcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubiA9IGZ1bmN0aW9uKG1vZHVsZSkge1xuIFx0XHR2YXIgZ2V0dGVyID0gbW9kdWxlICYmIG1vZHVsZS5fX2VzTW9kdWxlID9cbiBcdFx0XHRmdW5jdGlvbiBnZXREZWZhdWx0KCkgeyByZXR1cm4gbW9kdWxlWydkZWZhdWx0J107IH0gOlxuIFx0XHRcdGZ1bmN0aW9uIGdldE1vZHVsZUV4cG9ydHMoKSB7IHJldHVybiBtb2R1bGU7IH07XG4gXHRcdF9fd2VicGFja19yZXF1aXJlX18uZChnZXR0ZXIsICdhJywgZ2V0dGVyKTtcbiBcdFx0cmV0dXJuIGdldHRlcjtcbiBcdH07XG5cbiBcdC8vIE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbFxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5vID0gZnVuY3Rpb24ob2JqZWN0LCBwcm9wZXJ0eSkgeyByZXR1cm4gT2JqZWN0LnByb3RvdHlwZS5oYXNPd25Qcm9wZXJ0eS5jYWxsKG9iamVjdCwgcHJvcGVydHkpOyB9O1xuXG4gXHQvLyBfX3dlYnBhY2tfcHVibGljX3BhdGhfX1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5wID0gXCJcIjtcblxuXG4gXHQvLyBMb2FkIGVudHJ5IG1vZHVsZSBhbmQgcmV0dXJuIGV4cG9ydHNcbiBcdHJldHVybiBfX3dlYnBhY2tfcmVxdWlyZV9fKF9fd2VicGFja19yZXF1aXJlX18ucyA9IDMpO1xuIiwiaW1wb3J0ICQgZnJvbSAnanF1ZXJ5J1xuaW1wb3J0IHN0cmlwX3RhZ3MgZnJvbSAnLi9oZWxwZXJzL3N0cmlwLXRhZ3MnO1xuXG4vLyBjb25zb2xlLmxvZyh3cClcbmNvbnNvbGUubG9nKF90aGVtZW5hbWUpXG5cbi8vbGl2ZSB1cGRhdGUgYmxvZyB0aXRsZVxud3AuY3VzdG9taXplKCAnYmxvZ25hbWUnLCAodmFsdWUpID0+IHtcbiAgdmFsdWUuYmluZCggKHRvKSA9PiB7XG4gICAgICAkKCcuYy1oZWFkZXJfX2Jsb2duYW1lJykuaHRtbCh0byk7XG4gIH0gKVxufSlcblxud3AuY3VzdG9taXplKCAnX3RoZW1lbmFtZV9hY2NlbnRfY29sb3VyJywgKHZhbHVlKSA9PiB7XG4gIHZhbHVlLmJpbmQoICh0bykgPT4ge1xuICAgIC8vICQoJyNfdGhlbWVuYW1lLXN0eWxlc2hlZXQtaW5saW5lLWNzcycpLmh0bWwoXG4gICAgLy8gICBgXG4gICAgLy8gICAgIGEge1xuICAgIC8vICAgICAgIGNvbG9yOiAke3RvfVxuICAgIC8vICAgICB9XG4gICAgLy8gICAgIDpmb2N1c3tcbiAgICAvLyAgICAgICBvdXRsaW5lLWNvbG9yOiAke3RvfVxuICAgIC8vICAgICB9XG4gICAgLy8gICAgIC5jLXBvc3Quc3RpY2t5e1xuICAgIC8vICAgICAgIGJvcmRlci1sZWZ0LWNvbG9yOiAke3RvfVxuICAgIC8vICAgICB9XG4gICAgLy8gICAgICdidXR0b24sIGlucHV0W3R5cGU9c3VibWl0XSwgLmhlYWRlci1uYXYgLm1lbnUgPiAubWVudS1pdGVtOm5vdCgubWVnYSkgLnN1Yi1tZW51IC5tZW51LWl0ZW06aG92ZXIgPiBhIHtcbiAgICAvLyAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAke3RvfVxuICAgIC8vICAgICB9XG4gICAgLy8gICBgXG4gICAgLy8gKVxuXG4gICAgbGV0IGlubGluZV9jc3MgPSBgYDtcbiAgICBsZXQgaW5saW5lX2Nzc19vYmogPSBfdGhlbWVuYW1lWydpbmxpbmUtY3NzJ107XG4gICAgZm9yKGxldCBzZWxlY3RvciBpbiBpbmxpbmVfY3NzX29iaikge1xuICAgICAgICBpbmxpbmVfY3NzICs9IGAke3NlbGVjdG9yfSB7YDtcbiAgICAgICAgICAgIGZvcihsZXQgcHJvcCBpbiBpbmxpbmVfY3NzX29ialtzZWxlY3Rvcl0pIHtcbiAgICAgICAgICAgICAgICBsZXQgdmFsID0gaW5saW5lX2Nzc19vYmpbc2VsZWN0b3JdW3Byb3BdO1xuICAgICAgICAgICAgICAgIC8vIGdldCBhbnkgc2V0dGluZyBieSBpdHMgbmFtZSAodmFsKSBmcm9tIHdwIGRhdGFiYXNlXG4gICAgICAgICAgICAgICAgaW5saW5lX2NzcyArPSBgJHtwcm9wfTogJHt3cC5jdXN0b21pemUodmFsKS5nZXQoKX1gO1xuICAgICAgICAgICAgfSBcbiAgICAgICAgaW5saW5lX2NzcyArPSBgfWA7XG4gICAgfVxuICAgICQoJyNfdGhlbWVuYW1lLXN0eWxlc2hlZXQtaW5saW5lLWNzcycpLmh0bWwoaW5saW5lX2Nzcyk7XG4gIH0gKVxufSlcblxud3AuY3VzdG9taXplKCAnX3RoZW1lbmFtZV9zaXRlX2luZm8nLCAodmFsdWUpPT4ge1xuICAvL2JpbmQgbWVhbnMgd2UgYXJlIG5vdyBsaXN0ZW5pbmcgdG8gdGhlIGNoYW5nZSBldmVudHMgdG8gdGhlIGlucHV0IGZvciBzaXRlX2luZm8gc2V0dGluZ1xuICB2YWx1ZS5iaW5kKCh0bykgPT4ge1xuICAgIC8vdG8gaXMgbm93IHRoZSBpbnB1dCwgdXBkYXRlZCBldmVyeSB0aW1lIHNvbWV0aGluZyBpcyB0eXBlZFxuICAgIC8vY29uc29sZS5sb2codG8pO1xuICAgICQoJy5jLXNpdGUtaW5mb19fdGV4dCcpLmh0bWwoc3RyaXBfdGFncyh0bywgJzxhPicpKTtcbiAgfSlcbn0pIiwiLy9zdHJpcHMgYWxsIHRhZ3MsIGFwYXJ0IGZyb20gYWxsb3dlZCB0YWdzXG5jb25zdCBzdHJpcF90YWdzID0gKGlucHV0LCBhbGxvd2VkKSA9PiB7XG4gIGFsbG93ZWQgPSAoKChhbGxvd2VkIHx8ICcnKSArICcnKVxuICAudG9Mb3dlckNhc2UoKVxuICAubWF0Y2goLzxbYS16XVthLXowLTldKj4vZykgfHwgW10pXG4gIC5qb2luKCcnKTsgLy8gbWFraW5nIHN1cmUgdGhlIGFsbG93ZWQgYXJnIGlzIGEgc3RyaW5nIGNvbnRhaW5pbmcgb25seSB0YWdzIGluIGxvd2VyY2FzZSAoPGE+PGI+PGM+KVxuICB2YXIgdGFncyA9IC88XFwvPyhbYS16XVthLXowLTldKilcXGJbXj5dKj4vZ2ksXG4gIGNvbW1lbnRzQW5kUGhwVGFncyA9IC88IS0tW1xcc1xcU10qPy0tPnw8XFw/KD86cGhwKT9bXFxzXFxTXSo/XFw/Pi9naTtcbiAgcmV0dXJuIGlucHV0LnJlcGxhY2UoY29tbWVudHNBbmRQaHBUYWdzLCAnJylcbiAgLnJlcGxhY2UodGFncywgZnVuY3Rpb24oJDAsICQxKSB7XG4gICAgcmV0dXJuIGFsbG93ZWQuaW5kZXhPZignPCcgKyAkMS50b0xvd2VyQ2FzZSgpICsgJz4nKSA+IC0xID8gJDAgOiAnJztcbiAgfSk7XG59XG5cbmV4cG9ydCBkZWZhdWx0IHN0cmlwX3RhZ3M7IiwibW9kdWxlLmV4cG9ydHMgPSBqUXVlcnk7Il0sInNvdXJjZVJvb3QiOiIifQ==