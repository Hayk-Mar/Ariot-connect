// const server = require("http").createServer();

var http = require("http");
var connect = require('connect');

var app = connect();
app.use(function (req, res) {
  res.setHeader("Access-Control-Allow-Origin", "*");
  res.end('hello world\n');
});

const server = http.createServer(app);

const io = require("socket.io")(server);

const PORT = 4000;
const NEW_MESSAGE_EVENT = "newMessage";
const NEW_MESSAGE_EVENT_RASPBERRY = "newMessageFromRaspberry";

io.on("connection", (socket) => {
  console.log(`Client ${socket.id} connected`);

  // Join a conversation
  const { raspberryUUID } = socket.handshake.query;
  socket.join(raspberryUUID);

  io.in(raspberryUUID).emit('newConnect', {id: socket.id});

  // Listen for new messages
  socket.on(NEW_MESSAGE_EVENT, (data) => {
    io.in(raspberryUUID).emit(NEW_MESSAGE_EVENT, {...data, id: socket.id});
  });
  socket.on(NEW_MESSAGE_EVENT_RASPBERRY, (data) => {
    io.in(raspberryUUID).emit(NEW_MESSAGE_EVENT_RASPBERRY, {...data, id: socket.id});
  });

  // Leave the room if the user closes the socket
  socket.on("disconnect", () => {
    console.log(`Client ${socket.id} diconnected`);
    socket.leave(raspberryUUID);
  });
});

server.listen(PORT, () => {
  console.log(`Listening on port ${PORT}`);
});

