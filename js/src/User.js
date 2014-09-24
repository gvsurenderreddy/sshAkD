"use strict";

function User(id, name, home){
	this.id=id;
	this.name=name;
	this.home=home;
	this.keys=[];
		
	/* use ajax to create new key in backend */
}

User.prototype.render = function() {
  var $markup = $('<span>'+name+'</span>');
  /* Implement rendering of User... */
  return $markup;
}

User.prototype.toJSON = function() {
  /* implement toJSON */
}

User.prototype.addKey = function(key) {
	this.keys.push(key);
}

/*
 * persists the user to the repos.
 *
 * for user without id (not yet persisted) the id
 * is written back to the model after it is received from
 * the user.
 */
User.prototype.save = function() {
	var _that = this;
	var _url = 'http://localhost/sshAkD/php/user/';
	if (this.id) { _url += this.id; }
	$.post(_url, this.toJSON(), function(data) {
		_that.id = JSON.parse(data).id;
		window.location.hash = _that.id
	});
}