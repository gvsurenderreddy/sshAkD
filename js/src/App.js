"use strict";

var server;
var key;

$(function() {
    Server.load("1111", function(sl) {
      server = sl;
	  console.log(server);
    });
	
	Key.load("2222", function(kl) {
      key = kl;
	  console.log(key);
    });
});