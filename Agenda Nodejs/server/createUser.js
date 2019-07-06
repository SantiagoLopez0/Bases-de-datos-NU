let Usuario = require('./schemaUser.js'),
    mongoose = require('mongoose');

mongoose.connect('mongodb://localhost/agenda', { useNewUrlParser: true }, (err, connection)=>{

  let newUsers = new Usuario(
    {
      user: "User1",
      email: "user1@mail.com",
      password: "12345"
    });

    newUsers.save((err, doc)=>{
      console.log(err);
    });
});
