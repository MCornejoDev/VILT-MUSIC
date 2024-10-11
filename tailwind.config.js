// tailwind.config.js
module.exports = {
  content: [
    "./public/**/*.php",         // Archivos PHP en la carpeta public
    "./resources/**/*.php",      // Archivos PHP en la carpeta resources
    "./resources/css/**/*.css",  // Archivos CSS en resources/css
    "./resources/js/**/*.js",    // Archivos JavaScript en resources/js
    "./resources/layouts/**/*.php", // Archivos de layouts en resources/layouts
    "./src/**/*.js",             // Archivos JavaScript en src (si hay alguno)
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
