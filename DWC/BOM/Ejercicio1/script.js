const ventana = window.open("", "", "width=500, height=200, left=100, top=200");
ventana.focus();

//Asignamos una URL y un nombre a la ventana principal 
var url = "https://www.linkedin.com"
ventana.location.href = url;
ventana.name = "ventanaLinkedIn";

// Mostramos por pantalla la URL y el nombre
/* La url tenemos que mostrarla a través de la variable debido a que 
el navegador protege la url destino */
console.log("URL:", url);
console.log("Nombre:", ventana.name);

// Mostramos información del navegador, lenguaje y sistema
console.log("\n---- Navegador ---")
console.log("User Agent:", navigator.userAgent);
console.log("Idioma del navegador:", navigator.language);
console.log("Plataforma del sistema:", navigator.platform);

// Mostramos las diferentes propiedades de ancho
console.log("\n---- Anchura ---")
console.log("screen.width:", screen.width);
console.log("screen.availWidth:", screen.availWidth);
console.log("window.innerWidth:", ventana.innerWidth);
console.log("window.outerWidth:", ventana.outerWidth);

//Mostramos las diferentes propiedades de altura
console.log("\n---- Altura ---")
console.log("screen.height:", screen.height);
console.log("screen.availHeight:", screen.availHeight);
console.log("window.innerHeight:", ventana.innerHeight);
console.log("window.outerHeight:", ventana.outerHeight);

/* Imprimimos la página original ya que una página externa 
no se puede imprimir por motivos de seguridad del navegador*/
window.print();
