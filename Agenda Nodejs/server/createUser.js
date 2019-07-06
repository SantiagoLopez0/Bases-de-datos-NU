var Usuario = require('./schemaUser.js')

module.exports.crearUsuarios = function(callback){
  var arr = [
    { email: 'user1@mail.com',
      user: "User1", password: "12345"
    },
    {
      email: 'User2@hotmail.com',
      user: "Usuario2", password: "654321"
    }];
  Usuario.insertMany(arr, function(error, docs) {
    if (error){
      if (error.code == 11000){
        callback("USUARIO: User1, CONTRASEÑA: 12345");
      }else{
        callback(error.message);
      }
    }else{
      callback("Usuario registrado correctamente");
    }
  });
}
