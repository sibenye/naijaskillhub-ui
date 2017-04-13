/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
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
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
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
/******/ 	__webpack_require__.p = "./";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 48);
/******/ })
/************************************************************************/
/******/ ({

/***/ 11:
/***/ (function(module, exports) {

/**
 * Below are common functions for the NSH App
 */

startGlobalSpinner = function startGlobalSpinner() {
    var globalSpinnerTarget = document.getElementById('mdl-spinner-global');
    globalSpinnerTarget.classList.remove('nsh-hide');
    globalSpinnerTarget.classList.add('is-active');
    globalSpinnerTarget.classList.add('nsh-show');
};
stopGlobalSpinner = function stopGlobalSpinner() {
    var globalSpinnerTarget = document.getElementById('mdl-spinner-global');
    globalSpinnerTarget.classList.remove('is-active');
    globalSpinnerTarget.classList.remove('nsh-show');
    globalSpinnerTarget.classList.add('nsh-hide');
};

/**
 * Make Ajax request.
 * 
 * @param url
 * @param method
 * @param data
 * @param customResponseHandler
 * @param spinnerId
 * @returns
 */
makeRequest = function makeRequest(url, method, data) {
    var customResponseHandler = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
    var spinnerId = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : null;
    var contentType = arguments.length > 5 && arguments[5] !== undefined ? arguments[5] : 'application/json';
    var headers = arguments.length > 6 && arguments[6] !== undefined ? arguments[6] : null;

    httpRequest = new XMLHttpRequest();

    if (!httpRequest) {
        console.error('Giving up :( Cannot create an XMLHTTP instance');
        return false;
    }

    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                console.log(httpRequest.responseText);
                response = JSON.parse(httpRequest.responseText);
                if (customResponseHandler !== null) {
                    customResponseHandler('success', response.response);
                }
                console.log(response.status);
            } else if (httpRequest.status === 401) {
                //redirect to login page
                window.location.replace(window.location.protocol + '//' + window.location.hostname + "/login");
            } else {
                console.log(httpRequest.responseText);
                response = JSON.parse(httpRequest.responseText);
                if (customResponseHandler !== null) {
                    customResponseHandler('error', response.message);
                }
                console.error(response.message);
            }
            if (spinnerId !== null) {
                document.getElementById(spinnerId).classList.remove('is-active');
            }
        }
    };

    httpRequest.open(method, url);
    httpRequest.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    httpRequest.setRequestHeader('X-CSRF-TOKEN', window.Laravel.csrfToken);
    if (headers !== null) {
        Object.keys(headers).forEach(function (key) {
            httpRequest.setRequestHeader(key, headers[key]);
        });
    }

    if (method === 'POST' && contentType !== false) {
        httpRequest.setRequestHeader('Content-Type', contentType);
    }
    httpRequest.send(data);
};

fade = function fade(element, interval) {
    var op = 1; // initial opacity
    element.style.display = 'inline';
    var timer = setInterval(function () {
        if (op <= 0.1) {
            clearInterval(timer);
            element.style.display = 'none';
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op -= op * 0.1;
    }, interval);
};

unfade = function unfade(element, interval) {
    var op = 0.1; // initial opacity
    element.style.display = 'block';
    var timer = setInterval(function () {
        if (op >= 1) {
            clearInterval(timer);
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op += op * 0.1;
    }, interval);
};

/***/ }),

/***/ 48:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(11);


/***/ })

/******/ });