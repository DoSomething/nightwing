require('es6-promise').polyfill();
require('isomorphic-fetch');

var dataAction = require('data-action');
var actions = dataAction();

actions.before('[data-confirm]', function (element, parents) {
  if (!confirm(element.getAttribute('data-confirm'))) {
    throw new Error('action cancelled by user');
  }
});

actions.on('submit', function (element, parents) {
  var method = parents.getAttribute('data-method') || 'post';
  var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  return fetch(parents.getAttribute('data-path'), {
  	method: method,
  	credentials: 'same-origin', 
  	headers: {
  		'X-CSRF-TOKEN': token
  	}
  }).then(function(response) {
  	return response.json();
  }).then(function(json) {
  	if(!json.success) {
  		alert('There was an error! :(');
  	}

  	if(json.redirect) {
  		window.location = json.redirect;
  	}
  });
});