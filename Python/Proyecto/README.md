URL: https://books.toscrape.com/

Descripción: 

El sistema transforma el HTML crudo en dos entidades principales con una relación de 1:N en la base de datos SQLite:

1. Categoría
Representa las secciones temáticas del catálogo de libros.
nombre: El nombre de la categoría (ej: "Travel", "Mystery").
url: El enlace asociado a esa categoria.

2. Libro
Representa cada libro extraído. En su respectiva clase existen métodos para limpieza de datos o seguridad:
titulo: El título del libro.
precio: El coste del libro. Utiliza expresiones regulares internamente para limpiar el símbolo de la moneda ("£") y convertirlo en un tipo de dato float, permitiendo así operaciones matemáticas en la base de datos.
en_stock: Un valor booleano (`True` o `False`) transformado a partir del texto extraído de la web ("In stock").
categoria_id: Clave foránea con la entidad Categoría.

3. Arquitectura y Estructura
El proyecto divide los archivos en:
scraper/: Realiza peticiones HTTP simulando cabeceras de navegadores reales.
html_parser/: Aquí se encuentra la lógica de selectores CSS (BeautifulSoup) devolviendo datos simples y legibles.
models/: Contiene las clases de las tablas de la base de datos con la lógica de validación.
dao/: Gestiona la conexión a SQLite, creación e insertación de los datos de forma eficiente.
main.py: Archivo principal que orquesta todos los demás archivos para que el programa funcione correctamente.