"""
Docstring para Python.Unidad 7.Scraping POO.ejercicio_3
"""


class Book:
    """Clase que representa un libro con su información de scraping."""

    def __init__(self, titulo, precio, disponible, url):
        self.titulo = titulo
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

    def is_available(self):
        """Método para verificar si el libro está disponible."""
        if self.disponible or self.disponible == "Sí":
            return "Sí"
        else:
            return "No"


books_data = [
    {
        "titulo": "Python Básico",
        "precio": "18€",
        "disponible": "Sí",
        "url": "http://ejemplo.com/1",
    },
    {
        "titulo": "Python Avanzado",
        "precio": "35€",
        "disponible": "No",
        "url": "http://ejemplo.com/2",
    },
]

for data in books_data:
    libro = Book(
        titulo=data["titulo"],
        precio=data["precio"],
        disponible=data["disponible"] == "Sí",
        url=data["url"],
    )
    if libro.is_available() == "Sí":
        print(libro)
