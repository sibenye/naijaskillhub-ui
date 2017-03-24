/**
 * Below are customs functions for the NSH App
 */
//define variables
var httpRequest;

// define event listeners
document.getElementById("profileSaveBtn").addEventListener("click", saveUserProfile, false);
document.getElementById("uploadProfileImageBtn").addEventListener("change", uploadProfileImage, false);

/**
 * Handles user profile image upload.
 * 
 * @returns
 */
function uploadProfileImage() {
	var selectedFile = this.files[0];
	var contentType = selectedFile.type;
	console.log('contentType: ' + contentType);
	document.getElementById("mdl-spinner-profile-image").classList.add('is-active');
	makeRequest('account/profile/image/upload', 'POST', selectedFile, handleProfileImageUploadResponse, 'mdl-spinner-profile-image', contentType);
}

function handleProfileImageUploadResponse(status, message) {
	var imageElement = document.getElementById("profile-image");
	var notice = document.getElementById("profile-image-save-notice");
	
	if(status === 'success') {
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
	makeRequest('account/profile/edit', 'POST', JSON.stringify(formData), handleProfileSaveResponse, 'mdl-spinner-profile');
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
function makeRequest(url, method, data, customResponseHandler, spinnerId, contentType = 'application/json') {
    httpRequest = new XMLHttpRequest();

    if (!httpRequest) {
      console.error('Giving up :( Cannot create an XMLHTTP instance');
      return false;
    }
    
    httpRequest.onreadystatechange = function() {
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
    	    	  if (customResponseHandler !== undefined) {
    	    		  customResponseHandler('error', response.message);
    	    	  }
    	    	  console.error(response.message);
    	      }
    	      document.getElementById(spinnerId).classList.remove('is-active');
    	    }
    };
    
    httpRequest.open(method, url);
    httpRequest.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    httpRequest.setRequestHeader('X-CSRF-TOKEN', window.Laravel.csrfToken);
    if (method === 'POST') {
    	httpRequest.setRequestHeader('Content-Type', contentType);
    }
    httpRequest.send(data);
}

function fade(element, interval) {
    var op = 1;  // initial opacity
    element.style.display = 'inline';
    var timer = setInterval(function () {
        if (op <= 0.1){
            clearInterval(timer);
            element.style.display = 'none';
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op -= op * 0.1;
    }, interval);
}

function unfade(element, interval) {
    var op = 0.1;  // initial opacity
    element.style.display = 'block';
    var timer = setInterval(function () {
        if (op >= 1){
            clearInterval(timer);
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op += op * 0.1;
    }, interval);
}

