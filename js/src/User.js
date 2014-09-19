"use strict";

function User(id, name, ip, sudo, adminUser){
	this.id=id;
	this.name=name;
	this.ip=ip;
	this.sudo=sudo;
	this.adminUser=adminUser;
		
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

/*
 * persists the user to the repos.
 *
 * for user without id (not yet persisted) the id
 * is written back to the model after it is received from
 * the user.
 */
User.prototype.save = function() {
	var _that = this;
	var _url = 'http://localhost/sshAkD/php';
	if (this.id) { _url += this.id; }
	$.post(_url, this.toJSON(), function(data) {
		_that.id = JSON.parse(data).id;
		window.location.hash = _that.id
	});
}

/*
 * Loads the given user from the user.
 *
 * @param {string} id - unique identifier of the user to load
 * @param {function} callback - method to call after the user
 *   was successfully loaded. receives fully populated user
 *   object as first and only parameter.
 */
User.load = function(id, callback) {
  $.getJSON('http://localhost/sshAkD/php'+id, function(data) {
    var _user = new User()
    _user.id = data.id;
    _user.name = data.name;
	_user.ip = data.ip;
	_user.sudo = data.sudo;
	_user.adminUser = data.adminUser;
    callback(_user)
  });
}
