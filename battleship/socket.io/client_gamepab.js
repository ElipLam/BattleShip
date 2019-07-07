var socket = io.connect('http://localhost:3000', {reconnect: true});

var gamepad1 = document.getElementById('gamepad1');
var gamepad2 = document.getElementById('gamepad2');

socket.on('connect', function (socket) {
    console.log('Connected!');
});

socket.emit('check',{command:'check gamepads'});

socket.on('P1-available',function(data){
	gamepad1.style.backgroundColor = '#64FE2E';
});

socket.on('P2-available',function(data){
	gamepad2.style.backgroundColor = '#64FE2E';
});

socket.on('P1-unavailable',function(data){
	gamepad1.style.backgroundColor = '#E5E4E2';
});

socket.on('P2-unavailable',function(data){
	gamepad2.style.backgroundColor = '#E5E4E2';
});