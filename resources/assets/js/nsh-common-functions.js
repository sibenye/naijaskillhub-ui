/**
 * Below are common functions for the NSH App
 */

startGlobalSpinner = function () {
	var globalSpinnerTarget = document.getElementById('mdl-spinner-global');
	globalSpinnerTarget.classList.remove('nsh-hide');
	globalSpinnerTarget.classList.add('is-active');
	globalSpinnerTarget.classList.add('nsh-show');
}
stopGlobalSpinner = function () {
	var globalSpinnerTarget = document.getElementById('mdl-spinner-global');
	globalSpinnerTarget.classList.remove('is-active');
	globalSpinnerTarget.classList.remove('nsh-show');
	globalSpinnerTarget.classList.add('nsh-hide');
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
makeRequest = function (url, method, data, customResponseHandler = null, spinnerId = null, contentType = 'application/json', headers = null) {
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
    	    	  if (customResponseHandler !== null) {
    	    		  customResponseHandler('success', response.response);
    	    	  }
    	    	  console.log(response.status);
    	      } else if (httpRequest.status === 401) {
    	    	  //redirect to login page
    	    	  window.location.replace(window.location.protocol +'//' + window.location.hostname +"/login");
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
    	Object.keys(headers).forEach(function(key) {
        	httpRequest.setRequestHeader(key, headers[key]);
        });
    }
    
    if (method === 'POST' && contentType !== false) {
    	httpRequest.setRequestHeader('Content-Type', contentType);
    }
    httpRequest.send(data);
}

fade = function (element, interval) {
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

unfade = function (element, interval) {
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

