"""
Docstring para Python.Unidad 7.Scraping POO.ejercicio_4
"""


class Book:
    """Clase que representa un libro con su información de scraping."""

    def __init__(self, titulo, precio, disponible, url):
        self.__titulo = titulo
        self.precio = precio
        self.disponible = disponible
        self.url = url

    def __str__(self):
        return (
            f"\nTítulo: '{self.titulo}', "
            f"\nPrecio: {self.precio}, "
            f"\nDisponible: {self.is_available()}, "
            f"\nURL: '{self.url}'"
        )

    @property
    def titulo(self):
        """Propiedad para acceder al título del libro."""
        return self.__titulo

    @titulo.setter
    def titulo(self, nuevo_titulo):
        """Propiedad para modificar el título del libro."""
        if isinstance(nuevo_titulo, str) and nuevo_titulo.strip():
            self.__titulo = nuevo_titulo.strip()
        else:
            raise ValueError("El título debe ser una cadena no vacía.")

    def is_available(self):
        """Método para verificar si el libro está disponible."""
        if self.disponible or self.disponible == "Sí":
            return "Sí"
        else:
            return "No"

libro1 = Book("Python Básico", "18€", "Sí", "http://ejemplo.com/1")

libro1.titulo = "Python para Todos"

print(libro1)

# Lanza un ValueError porque el título no puede ser una cadena vacía
# libro1.titulo = ""
