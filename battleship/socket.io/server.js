//server.js
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

io.on('connection', function (socket){
    var esp1='off';
    var esp2='off';
	console.log('client connected!');
    socket.emit('welcome', {message: 'Connected !!!!'});
	socket.on('connection', function(message) {
        console.log(message);
    });
    
    socket.on('disconnect', function(message){
        console.log('Client disconnected!');
    });
    //Room
    socket.on('esp1', function(message){
        socket.join('room1');    
        console.log('ESP1 joined Room1');
        esp1='on';
    });
    socket.on('esp2', function(message){
        socket.join('room2');    
        console.log('ESP2 joined Room2');
        esp2='on';
    });
    socket.on('Player1', function(message){
        socket.join('room1');    
        console.log('Player1 joined Room1');
    });
    socket.on('Player2', function(message){
        socket.join('room2');    
        console.log('Player2 joined Room2');
    });
    //handler request buttons P1
    socket.on('P1-A', function(message){
        console.log("client say A");
		io.to('room1').emit('A', {command: 'P1-A'});
    });
    socket.on('P1-UP', function(message){
        console.log("client say UP");
		io.to('room1').emit('UP', {command: 'P1-UP'});
    });
    socket.on('P1-DOWN', function(message){
        console.log("client say DOWN");
		io.to('room1').emit('DOWN', {command: 'P1-DOWN'});
    });
    socket.on('P1-LEFT', function(message){
        console.log("client say LEFT");
		io.to('room1').emit('LEFT', {command: 'P1-LEFT'});
    });
    socket.on('P1-RIGHT', function(message){
        console.log("client say RIGHT");
		io.to('room1').emit('RIGHT', {command: 'P1-RIGHT'});
    });
    socket.on('P1-B', function(message){
        console.log("client say B");
		io.to('room1').emit('B', {command: 'P1-B'});
    });
    socket.on('FIRE', function(message){
        console.log("client say FIRE");
		io.to('room1').emit('FIRE', {command: 'FIRE'});
    });

    //handler request buttons P2
    socket.on('P2-A', function(message){
        console.log("client say A");
		io.to('room2').emit('A', {command: 'P2-A'});
    });
    socket.on('P2-UP', function(message){
        console.log("client say UP");
		io.to('room2').emit('UP', {command: 'P2-UP'});
    });
    socket.on('P2-DOWN', function(message){
        console.log("client say DOWN");
		io.to('room2').emit('DOWN', {command: 'P2-DOWN'});
    });
    socket.on('P2-LEFT', function(message){
        console.log("client say LEFT");
		io.to('room2').emit('LEFT', {command: 'P2-LEFT'});
    });
    socket.on('P2-RIGHT', function(message){
        console.log("client say RIGHT");
		io.to('room2').emit('RIGHT', {command: 'P2-RIGHT'});
    });
    socket.on('P2-B', function(message){
        console.log("client say B");
		io.to('room2').emit('B', {command: 'P2-B'});
    });
    //
    socket.on('check', function(message){
        if (esp1=='on'){
            socket.emit('P1-available', {message: 'P1-available'});
        }
        else {
            socket.emit('P1-unavailable', {message: 'P1-unavailable'});
        }
        if (esp2=='on'){
            socket.emit('P2-available', {message: 'P2-available'});
        }
        else {
            socket.emit('P2-unavailable', {message: 'P2-unavailable'});
        }
    });

});
    

http.listen(3000, function () {
  console.log('listening on *:3000');
});
