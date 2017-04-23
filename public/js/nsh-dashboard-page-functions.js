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
/******/ 	return __webpack_require__(__webpack_require__.s = 49);
/******/ })
/************************************************************************/
/******/ ({

/***/ 12:
/***/ (function(module, exports) {

/**
 * Below are functions for the dashboard page
 */

//define variables
var httpRequest;
var imageIdForDelete = null;
var audioIdForDelete = null;
var videoIdForDelete = null;

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

/* edit portfolio video */
editPortfolioVideo = function editPortfolioVideo(videoId) {
	//just go to the edit page
	goTo("/account/portfolio/video/edit/" + videoId);
};
/* edit portfolio video - end */

/* edit portfolio audio */
editPortfolioAudio = function editPortfolioAudio(audioId) {
	//just go to the edit page
	goTo("/account/portfolio/audio/edit/" + audioId);
};
/* edit portfolio audio - end */

/* edit portfolio image */
editPortfolioImage = function editPortfolioImage(imageId) {
	//just go to the edit page
	goTo("/account/portfolio/image/edit/" + imageId);
};
/* edit portfolio image - end */

/* delete portfolio video */
deletePortfolioVideo = function deletePortfolioVideo(videoId) {
	var data = { videoId: videoId };
	videoIdForDelete = videoId;
	var endpoint = '/account/portfolio/video?videoId=' + videoId;
	//start spinner
	startGlobalSpinner();
	makeRequest(endpoint, 'DELETE', null, handlePortfolioVideoDeleteResponse, null);
};

function handlePortfolioVideoDeleteResponse(status, message) {

	if (status === 'success') {
		console.log(message);
		//remove video block
		removeVideoBlock(videoIdForDelete);
	} else {
		console.error(message);
	}
	audioIdForDelete = null;
	stopGlobalSpinner();
}

function removeVideoBlock(videoId) {
	if (videoId !== null) {
		var videoList = document.getElementById('portfolioVideoList');
		var videoBlock = document.getElementById('videoBlock-' + videoId);
		videoList.removeChild(videoBlock);
	}
}

/* delete portfolio video - end */

/* delete portfolio audio */
deletePortfolioAudio = function deletePortfolioAudio(audioId) {
	var data = { audioId: audioId };
	audioIdForDelete = audioId;
	var endpoint = '/account/portfolio/audio?audioId=' + audioId;
	//start spinner
	startGlobalSpinner();
	makeRequest(endpoint, 'DELETE', null, handlePortfolioAudioDeleteResponse, null);
};

function handlePortfolioAudioDeleteResponse(status, message) {

	if (status === 'success') {
		console.log(message);
		//remove audio block
		removeAudioBlock(audioIdForDelete);
	} else {
		console.error(message);
	}
	audioIdForDelete = null;
	stopGlobalSpinner();
}

function removeAudioBlock(audioId) {
	if (audioId !== null) {
		var audioList = document.getElementById('portfolioAudioList');
		var audioBlock = document.getElementById('audioBlock-' + audioId);
		audioList.removeChild(audioBlock);
	}
}

/* delete portfolio audio - end */

/* delete portfolio image */
deletePortfolioImage = function deletePortfolioImage(imageId) {
	var data = { imageId: imageId };
	imageIdForDelete = imageId;
	var endpoint = '/account/portfolio/image?imageId=' + imageId;
	//start spinner
	startGlobalSpinner();
	makeRequest(endpoint, 'DELETE', null, handlePortfolioImageDeleteResponse, null);
};

function handlePortfolioImageDeleteResponse(status, message) {

	if (status === 'success') {
		console.log(message);
		//remove image block
		removeImageBlock(imageIdForDelete);
	} else {
		console.error(message);
	}
	imageIdForDelete = null;
	stopGlobalSpinner();
}

function removeImageBlock(imageId) {
	if (imageId !== null) {
		var imageList = document.getElementById('portfolioImageList');
		var imageBlock = document.getElementById('imageBlock-' + imageId);
		imageList.removeChild(imageBlock);
	}
}

/* delete portfolio image - end */

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
	makeRequest('/account/profile/image/upload', 'POST', selectedFile, handleProfileImageUploadResponse, 'mdl-spinner-profile-image', contentType);
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
	var bio = document.getElementById("profile-bio").value;

	var formElement = document.getElementById("profile-edit-form");

	var formData = {
		firstName: firstName,
		lastName: lastName,
		city: city,
		state: state,
		gender: gender,
		yob: yob,
		bio: bio
	};
	console.log(formData);

	document.getElementById("mdl-spinner-profile").classList.add('is-active');
	makeRequest('/account/profile/edit', 'POST', JSON.stringify(formData), handleProfileSaveResponse, 'mdl-spinner-profile');
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

/***/ }),

/***/ 49:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(12);


/***/ })

/******/ });