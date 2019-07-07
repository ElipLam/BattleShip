//client.js
//var io = require('socket.io-client');
var player = document.getElementById('Player').value
var socket = io.connect('http://13.59.254.81:3000', {reconnect: true});

// Add a connect listener
socket.on('connect', function (socket) {
    console.log('Connected!');
    console.log(player);
    selectgamepad(player);
});
socket.on('A', function(socket){
	console.log('Server say A');
});
socket.on('UP', function(socket){
	console.log('Server say UP');		//'38'
	//checkinput('38');
});
socket.on('DOWN', function(socket){
	console.log('Server say DOWN');		//'40'
	//checkinput('40');
});
socket.on('LEFT', function(socket){
	console.log('Server say LEFT');		//'37'
	//checkinput('37');
});
socket.on('RIGHT', function(socket){
	console.log('Server say RIGHT');	//'39'
	//checkinput('39');
});
socket.on('B', function(socket){
	console.log('Server say B');
	//checkinput('13');
});
socket.on('FIRE', function(socket){
	console.log('Server say FIRE');		//'13'
	//checkinput('13');
});



/// function
function selectgamepad(player)
{
	if(player == 'Player1')
	{
		socket.emit('Player1', {message: 'Player'});
	}
	else if(player == 'Player2')
	{
		socket.emit('Player2', {message: 'Player'});
	}

}