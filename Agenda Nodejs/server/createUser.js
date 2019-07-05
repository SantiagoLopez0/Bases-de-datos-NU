var Usuario = require('./schemaUser.js')

module.exports.crearUsuarioDemo = function(callback){
  var arr = [{ email: 'user1@mail.com', user: "User1", password: "12345"}, { email: 'User2@hotmail.com', user: "Usuario2", password: "654321"}];
  Usuario.insertMany(arr, function(error, docs) {
    if (error){
      console.log(error.message)
    }else{
      console.log("Usuario registrado correctamente");
    }
  });
}
