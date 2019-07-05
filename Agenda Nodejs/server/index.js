const http = require('http'),
      path = require('path'),
      express = require('express'),
      bodyParser = require('body-parser'),
      session = require('express-session'),
      mongoose = require('mongoose');

const PORT = 8082;
const app = express();

const Server = http.createServer(app);

const RoutingUser = require('./rutasUsuarios.js'),
      RoutingEvent = require('./rutasEventos.js');

mongoose.connect('mongodb://localhost/agenda');


app.use(express.static('../client'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true}));
app.use(session({
    secret: 'secret-pass',
    cookie: { maxAge: 3600000 },
    resave: false,
    saveUninitialized: true,
  }));

app.use('/usuarios', RoutingUser);
app.use('/events', RoutingEvent);

Server.listen(PORT, function() {
  console.log('Server is listeng on port: ' + PORT)
});
