"""
    Archivo principal
"""
import sys
import sqlite3
import requests

from scraping import BookScraper
from general import Categoria
from general import CategoriaDAO, LibroDAO

def main():
    """
        Función principal que orquesta el flujo completo del programa:
        1. Scraping de categorías
        2. Parseo y persistencia de categorías
        3. Scraping profundo de libros por categoría
        4. Persistencia masiva de libros
        5. Consultas y filtrado para verificación
    """
    print("Iniciando pipeline de extracción de datos...")

    # Inicialización
    scraper = BookScraper()
    cat_dao = CategoriaDAO()
    libro_dao = LibroDAO()

    try:
        # 1. Scraping de Categorías
        categorias_data = scraper.extraer_categorias()
        print(f"Se encontraron {len(categorias_data)} categorías objetivo.")

        # 2. Parseo y Persistencia
        for cat_data in categorias_data:
            # Modelo
            categoria = Categoria(cat_data["nombre"], cat_data["url"])
            # DAO
            cat_id = cat_dao.insert(categoria)
            print(f"\nProcesando {categoria} (ID: {cat_id})...")

            # 3. Scraping Profundo (Libros por Categoría)
            libros = scraper.extraer_libros_de_categoria(categoria.url, cat_id)
            print(f"Extraídos {len(libros)} libros validados. Guardando en DB...")

            # Inserción masiva para eficiencia
            libro_dao.bulk_insert(libros)

    except (requests.exceptions.RequestException, sqlite3.Error, ValueError) as e:
        print(f"Error crítico en la ejecución del pipeline: {e}")
        sys.exit(1)

    # 4. Consultas y Filtrado (Comprobación de DB)
    print("\n--- RESUMEN DE BASE DE DATOS ---")
    todos_los_libros = libro_dao.select_all()
    print(f"Total de libros persistidos: {len(todos_los_libros)}")

    print("\n--- FILTRO: Libros en stock por menos de 20£ ---")
    libros_baratos = libro_dao.select_filtered(20.0)
    for titulo, precio in libros_baratos:
        print(f"- {titulo} ({precio}£)")


if __name__ == "__main__":
    main()
