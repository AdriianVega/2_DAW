"""
Orquestador principal.
Coordinamos las capas del sistema.
"""
import sys
import sqlite3
import requests

from scraper.scraper_engine import WebScraper
from html_parser.entidad_parser import WebParser
from models.entidad import Categoria, Libro
from dao.entidad_dao import CategoriaDAO, LibroDAO

def main():
    """Ejecutamos el código principal para extracción y guardado."""
    print("Iniciando...")
    url = "https://books.toscrape.com/"

    # Instanciamos los objetos de cada capa por separado
    scraper = WebScraper()
    parser = WebParser()
    categoria_dao = CategoriaDAO()
    libro_dao = LibroDAO()

    try:
        html_index = scraper.obtener_html(url)
        categorias_dict = parser.parsear_categorias(html_index, url)
        print(f"Se encontraron {len(categorias_dict)} categorías.")

        for categoria_data in categorias_dict:
            # Instanciamos y persistimos el modelo Categoría obteniendo su ID
            categoria = Categoria(categoria_data["nombre"], categoria_data["url"])
            cat_id = categoria_dao.insert(categoria)
            print(f"\nProcesando {categoria} (ID = {cat_id})")

            html_categoria = scraper.obtener_html(categoria.url)
            libros_dict = parser.parsear_libros(html_categoria)

            # Generamos los objetos Libro aplicando la validación y limpieza de datos interna
            objetos_libro = [
                Libro(l["titulo"], l["precio"], l["stock"], cat_id)
                for l in libros_dict
            ]

            libro_dao.bulk_insert(objetos_libro)
            print(f"Guardados {len(objetos_libro)} libros.")

    except (requests.exceptions.RequestException, sqlite3.Error, ValueError) as e:
        # Abortamos de forma limpia si falla la red, la base de datos o la validación
        print(f"Error crítico en la ejecución: {e}")
        sys.exit(1)

    print("\nLibros en stock por menos de 20£\n")
    libros_baratos = libro_dao.select_filtered(20.0)
    for titulo, precio in libros_baratos:
        print(f"- {titulo} ({precio}£)")


if __name__ == "__main__":
    main()
