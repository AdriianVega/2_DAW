"""
Ejercicio 1
"""

from bs4 import BeautifulSoup
import requests


class Book:
    """Clase que representa un libro con su información de scraping."""

    def __init__(self, titulo, precio, disponible, url):
        self.titulo = titulo
        self.precio = precio
        self.disponible = disponible
        self.url = url


def obtener_libros(url_pagina):
    """
    Realiza scraping de una página web para extraer información de libros.
    """

    try:
        response = requests.get(url_pagina, timeout=10)
        soup = BeautifulSoup(response.content, "html.parser")

        libros = []

        for libro_element in soup.select("article.product_pod"):
            titulo = libro_element.select_one("h3 a")["title"]
            precio = float(
                libro_element.select_one("p.price_color").text.strip().replace("£", "")
            )

            disponible = (
                "In stock" in libro_element.select_one("p.instock").text.strip()
            )
            url = url_pagina

            libros.append(Book(titulo, precio, disponible, url))

        return libros

    except requests.exceptions.RequestException as e:
        print(f"Error al obtener la página: {e}")
        return []


libros_obtenidos = obtener_libros(
    "http://books.toscrape.com/catalogue/category/books/science_22/index.html"
)

for libro in libros_obtenidos:
    print(
        f"\nTítulo: {libro.titulo}, "
        f"\nPrecio: {libro.precio}, "
        f"\nDisponible: {libro.disponible}, "
        f"\nURL: {libro.url}\n"
    )
