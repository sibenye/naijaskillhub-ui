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
/******/ 	return __webpack_require__(__webpack_require__.s = 46);
/******/ })
/************************************************************************/
/******/ ({

/***/ 11:
/***/ (function(module, exports) {

/**
 * Below are customs functions for the NSH App
 */
//define variables
var httpRequest;

/* define event listeners */
if (document.getElementById("profileSaveBtn") != undefined) {
  document.getElementById("profileSaveBtn").addEventListener("click", saveUserProfile, false);
}
if (document.getElementById("uploadProfileImageBtn") != undefined) {
  document.getElementById("uploadProfileImageBtn").addEventListener("change", uploadProfileImage, false);
}
if (document.getElementById("portfolioImageUploadSelection") != undefined) {
  document.getElementById("portfolioImageUploadSelection").addEventListener("change", displaySelectedPortfolioImage, false);
}

/* define event listeners - end */

/* display portfolio image selected */
function displaySelectedPortfolioImage() {
  var selectedFile = this.files[0];
  var reader = new FileReader();

  var imageSection = document.getElementById("portfolioImagePreviewSection");
  var imageDiv = document.getElementById("portfolioImagePreview");
  reader.onload = function (e) {
    imageDiv.setAttribute('src', e.target.result);
    imageSection.classList.remove("nsh-hide");
  };

  reader.readAsDataURL(selectedFile);
}

/* portfolio image upload - end */

/* profile image handle functions */
/**
 * Handles user profile image upload.
 * 
 * @returns
 */
function uploadProfileImage() {
  var selectedFile = this.files[0];
  var contentType = selectedFile.type;
  //TODO: validate contentType
  document.getElementById("mdl-spinner-profile-image").classList.add('is-active');
  makeRequest('dashboard/profile/image/upload', 'POST', selectedFile, handleProfileImageUploadResponse, 'mdl-spinner-profile-image', contentType);
}

function handleProfileImageUploadResponse(status, message) {
  var imageElement = document.getElementById("profile-image");
  var notice = document.getElementById("profile-image-save-notice");

  if (status === 'success') {
    var uploadAdd = document.getElementById("upload-text-add");
    var uploadChange = document.getElementById("upload-text-change");

    imageElement.setAttribute('src', message.fileSrc);
    imageElement.style.display = 'block';

    notice.className = 'nsh-save-notice-success';
    notice.innerHTML = 'Uploaded';

    uploadAdd.style.display = 'none';
    uploadChange.style.display = 'inline';
    fade(notice, 150);
  } else {
    notice.className = 'nsh-save-notice-error';
    notice.innerHTML = 'Error';
  }
}
/* profile image handle functions - end */

/**
 * Handle user profile form submit.
 * 
 * @returns
 */
function saveUserProfile() {
  var firstName = document.getElementById("profile-firstName").value;
  var lastName = document.getElementById("profile-lastName").value;
  var city = document.getElementById("profile-city").value;
  var state = document.getElementById("profile-state").value;
  var gender = document.getElementById("profile-gender").value;
  var yob = document.getElementById("profile-yob").value;

  var formElement = document.getElementById("profile-edit-form");

  var formData = {
    firstName: firstName,
    lastName: lastName,
    city: city,
    state: state,
    gender: gender,
    yob: yob
  };
  console.log(formData);

  document.getElementById("mdl-spinner-profile").classList.add('is-active');
  makeRequest('dashboard/profile/edit', 'POST', JSON.stringify(formData), handleProfileSaveResponse, 'mdl-spinner-profile');
}

/**
 * Handle response from profile save ajax request.
 * 
 * @param status
 * @param message
 * @returns
 */
function handleProfileSaveResponse(status, message) {
  var notice = document.getElementById("profile-save-notice");
  if (status === 'success') {
    notice.className = 'nsh-save-notice-success';
    notice.innerHTML = 'Saved';
    fade(notice, 150);
  } else {
    notice.className = 'nsh-save-notice-error';
    notice.innerHTML = 'Error';
  }
}

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
function makeRequest(url, method, data) {
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
        if (customResponseHandler !== undefined) {
          customResponseHandler('success', response.response);
        }
        console.log(response.status);
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
}

function fade(element, interval) {
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
}

function unfade(element, interval) {
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
}

/***/ }),

/***/ 46:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(11);


/***/ })

/******/ });