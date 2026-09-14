const fs = require('fs');
const path = require('path');

const carpeta = '../../frontend/image/categoria';

function listarArchivosSinExtension(carpeta) {
  fs.readdir(carpeta, (err, archivos) => {
    if (err) {
      console.error('Error al leer la carpeta:', err);
      return;
    }

    archivos.forEach((archivo) => {
      const nombreSinExtension = path.parse(archivo).name;
      console.log(nombreSinExtension);
    });
  });
}

listarArchivosSinExtension(carpeta);
