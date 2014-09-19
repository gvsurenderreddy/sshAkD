"use strict";

function Key(id, name, pubKey){
	this.id=id;
	this.name=name;
	this.pubKey=pubKey;
	
	/* use ajax to create new key in backend */
}


Key.prototype.render = function() {
  var $markup = $('<span>'+name+'</span>');
  /* Implement rendering of Key... */
  return $markup;
}

Key.prototype.toJSON = function() {
  /* implement toJSON */
}

/*
 * persists the key to the repos.
 *
 * for key without id (not yet persisted) the id
 * is written back to the model after it is received from
 * the key.
 */
Key.prototype.save = function() {
	var _that = this;
	var _url = 'http://localhost/sshAkD/php';
	if (this.id) { _url += this.id; }
	$.post(_url, this.toJSON(), function(data) {
		_that.id = JSON.parse(data).id;
		window.location.hash = _that.id
	});
}

/*
 * Loads the given key from the key.
 *
 * @param {string} id - unique identifier of the key to load
 * @param {function} callback - method to call after the key
 *   was successfully loaded. receives fully populated key
 *   object as first and only parameter.
 */
Key.load = function(id, callback) {
  $.getJSON('http://localhost/sshAkD/php'+id, function(data) {
    var _key = new Key()
    _key.id = data.id;
    _key.name = data.name;
	_key.ip = data.ip;
	_key.sudo = data.sudo;
	_key.adminUser = data.adminUser;
    callback(_key)
  });
}
