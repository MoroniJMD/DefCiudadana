var mysql = require('mysql');
var express = require('express');
var bodyParser = require('body-parser');

var con = mysql.createConnection({
    host: "localhost",
    user: "tu_usuario",
    password: "tu_contraseña",
    database: "proyecto"
});

con.connect(function(err) {
    if (err) throw err;
    console.log("Conectado a la base de datos MySQL!");
});

var app = express();
app.use(bodyParser.urlencoded({ extended: true }));

app.post('/node.js', function(req, res) {
    var name = req.body['new-email']; // Asegúrate de que los nombres coincidan con los de tu formulario
    var password = req.body['new-password'];

    var sql = "INSERT INTO user (name, password) VALUES (?, ?)";
    con.query(sql, [name, password], function(err, result) {
        if (err) throw err;
        console.log("1 registro insertado");
        res.send('Registro completado');
    });
});

app.listen(3000, function() {
    console.log('Servidor ejecutándose en el puerto 3000');
});