const Router = require('express').Router();
const Users = require('./schemaUser.js');

Router.post('/login', function(req, res) {
    let user = req.body.user;
    let password = req.body.pass;
    let session = req.session;

    Users.find({user: user}).count({}, function(err, count) {
        if (err) {
            res.status(500);
            res.json(err);
        }else{
          if(count == 1){
            Users.find({user: user, password: password }).count({}, function(err, count) {
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
