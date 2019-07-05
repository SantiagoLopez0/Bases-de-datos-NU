const http = require('http'),
      path = require('path'),
      express = require('express'),
      bodyParser = require('body-parser'),
      mongoose = require('mongoose');

const PORT = 8082
const app = express()

const Server = http.createServer(app)

const routingUser = require('./rutasUsuarios.js');
const routingEvent = require('./rutasEventos.js');

mongoose.connect('mongodb://localhost/agenda')


app.use(express.static('./client'))
app.use(bodyParser.json())
app.use(bodyParser.urlencoded({ extended: true}))
app.use('/users', routingUser)
app.use('/event', routingEvent)

Server.listen(PORT, function() {
  console.log('Server is listeng on port: ' + PORT)
})
