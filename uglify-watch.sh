#!/bin/bash

# Crea el directorio de destino si no existe
mkdir -p public/js

# Ejecuta UglifyJS en cada cambio
npx uglify-js resources/js/main.js -o public/js/app.min.js --compress --mangle
