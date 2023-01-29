let fs = require('fs');
let path = require('path');
let express = require("express");
let callBack = express();

callBack.use("/dni", function (request, response) {
    if (request.query.num) {
        var dniFull = letraDNI(request.query.num);
        response.send("Este es tu dni completo: " + dniFull);
    } else {
        fs.readFile('instrucciones.html', function (err, dato) {
            response.writeHead(200, { 'Content-Type': 'text/html;charset=utf-8' });
            response.write(dato);
            response.end();
        });
    }
});

callBack.use("/escribir", function () {
    createDir(path.resolve('./Copia'));
    createFile();
});

callBack.listen(8083, '127.0.0.3', function () {
    console.log('Servidor ejecutándose en http://127.0.0.3:8083');
});

//Functions utils

let createDir = function (dirPath) {
    try {
        fs.mkdirSync(dirPath);
    } catch (err) {
        if (err.code !== 'EEXIST') throw err
    }
}

let letraDNI = function (dni) {
    var cadena = "TRWAGMYFPDXBNJZSQVHLCKET";
    var posicion = dni % 23;
    var letra = cadena.substring(posicion, posicion + 1);
    return dni + " - " + letra;
}

let createFile = function () {
    var nameFile = "holaMundo";
    fs.appendFile('./Copia/' + nameFile + '.txt', 'José Ignacio Barragán', (error) => {
        if (error) {
            throw error;
        }
        console.log("Se ha creado el archivo: " + nameFile + ".txt")
    });
}



