import { spawn } from 'node:child_process';
import { existsSync } from 'node:fs';

// Lista de rutas posibles (Windows capado vs Arch Linux)
const possiblePaths = [
  'C:/xampp/php/php.exe', // Ruta XAMPP en Windows
  'php'                   // Comando global (funciona en tu Arch)
];

// Buscamos el ejecutable que esté disponible
const phpBinary = possiblePaths.find(path => {
  if (path === 'php') return true; // Confiamos en que el shell lo encuentre si es global
  return existsSync(path);
});

if (!phpBinary) {
  console.error('❌ Error: No se encontró PHP en las rutas definidas.');
  process.exit(1);
}

console.log(`\x1b[35m[PHP]\x1b[0m Usando binario en: ${phpBinary}`);

const phpServer = spawn(phpBinary, ['-S', 'localhost:8000'], {
  stdio: 'inherit',
  shell: true
});

phpServer.on('error', (err) => {
  console.error(`\x1b[31m[PHP] Error al iniciar el servidor: ${err.message}\x1b[0m`);
});