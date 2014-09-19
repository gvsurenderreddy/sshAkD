"use strict";

function Server(id, name, ip, sudo, adminUser){
	this.id=id;
	this.name=name;
	this.ip=ip;
	this.sudo=sudo;
	this.adminUser=adminUser;
		
	/* use ajax to create new key in backend */
}

Server.prototype.render = function() {
  var $markup = $('<span>'+name+'</span>');
  /* Implement rendering of Server... */
  return $markup;
}

Server.prototype.toJSON = function() {
  /* implement toJSON */
}

/*
 * persists the server to the repos.
 *
 * for server without id (not yet persisted) the id
 * is written back to the model after it is received from
 * the server.
 */
Server.prototype.save = function() {
	var _that = this;
	var _url = 'http://localhost/sshAkD/php';
	if (this.id) { _url += this.id; }
	$.post(_url, this.toJSON(), function(data) {
		_that.id = JSON.parse(data).id;
		window.location.hash = _that.id
	});
}

/*
 * Loads the given server from the server.
 *
 * @param {string} id - unique identifier of the server to load
 * @param {function} callback - method to call after the server
 *   was successfully loaded. receives fully populated server
 *   object as first and only parameter.
 */
Server.load = function(id, callback) {
  $.getJSON('http://localhost/sshAkD/php'+id, function(data) {
    var _server = new Server()
    _server.id = data.id;
    _server.name = data.name;
	_server.ip = data.ip;
	_server.sudo = data.sudo;
	_server.adminUser = data.adminUser;
    callback(_server)
  });
}
