const mongoose = require('mongoose'),
    Schema = mongoose.Schema,
    Usuarios = require('./schemaUser.js'),
    autoIncrement = require('mongoose-auto-increment');

    let EventSchema = new Schema({
      title:{ type: String, required: true },
      start: { type: String, required: true },
      end: { type: String, required: false },
      user: { type: Schema.ObjectId, ref: "Usuario" }
    });


EventSchema.plugin(autoIncrement.plugin, {model: 'Evento', startAt: 1} );

let EventoModel = mongoose.model('Evento', EventSchema)

module.exports = EventoModel;
