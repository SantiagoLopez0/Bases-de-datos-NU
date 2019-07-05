const Router = require('express').Router();
const Users = require('./schemaUser.js');
const Eventos = require('./schemaEvent.js')
const Registro = require('./createUser.js')


Router.get('/verificar', function(req, res) {
  Users.find({user: req.query.user}).count({}, function(err, count) {
    if(count>0){
        res.send("Usuarios existentes \n USUARIO: user1 \n PSW: 12345");
    }else{
      Eventos.find({}).count({}, function(err, count) {
        if(count>0){
          Eventos.remove({},function(err, doc){
          if(err){
            console.log(err);
          }else{
            console.log("Eventos eliminados");
          }
        })
      }
    })
    Registro.crearUsuarios((error, result) => {
        if(error){
          res.send(error);
        }else{
          res.send(result);
        }
      })
    }
  })
})


Router.post('/login', function(req, res) {
    let user = req.body.user;
    let password = req.body.pass;
    let session = req.session;

    Usuarios.find({user: user}).count({}, function(err, count) {
        if (err) {
            res.status(500);
            res.json(err);
        }else{
          if(count == 1){
            Usuarios.find({user: user, password: password }).count({}, function(err, count) {
                if (err) {
                    res.status(500);
                    res.json(err);
                }else{
                  if(count == 1){
                    session.user = req.body.user;
                    res.send("Validado");
                  }else{
                    res.send("Contraseña incorrecta");
                  }
                }
            })
          }else{
            res.send("Usuario no registrado");
          }
        }

    })
})


Router.post('/logout', function(req, res) {
  req.session.destroy(function(err) {
  if(err) {
    console.log(err);
    res.json(err);
  } else {
    req.session = null;
    res.send('logout');
    res.end();
  }
  });
});

module.exports = Router;
