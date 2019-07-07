//client.js
//var io = require('socket.io-client');
var socket = io.connect('http://10.0.0.194:3000', {reconnect: true});
socket.emit('Player1', {message: 'Player'});
// Add a connect listener
socket.on('connect', function (socket) {
    console.log('Connected!');
});
socket.on('A', function(socket){
	console.log('Server say A');
});
socket.on('UP', function(socket){
	console.log('Server say UP');		//'38'
	checkinput('38');
});
socket.on('DOWN', function(socket){
	console.log('Server say DOWN');		//'40'
	checkinput('40');
});
socket.on('LEFT', function(socket){
	console.log('Server say LEFT');		//'37'
	checkinput('37');
});
socket.on('RIGHT', function(socket){
	console.log('Server say RIGHT');	//'39'
	checkinput('39');
});
socket.on('B', function(socket){
	console.log('Server say B');
	checkinput('13');
});
socket.on('FIRE', function(socket){
	console.log('Server say FIRE');		//'13'
	checkinput('13');
});

