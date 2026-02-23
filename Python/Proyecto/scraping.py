"""
    Módulo de scraping y parseo de datos.
    - BookScraper: Clase que gestiona la descarga y parseo de datos desde el sitio web.
"""
import requests
from bs4 import BeautifulSoup
from general import Libro

class BookScraper:
    """Gestiona la descarga y parseo de datos."""

    def __init__(self, base_url="https://books.toscrape.com/"):
        self.base_url = base_url
        self.headers = {
            "User-Agent": (
                "Mozilla/5.0 (X11; Linux x86_64) "
                "AppleWebKit/537.36 (KHTML, like Gecko) "
                "Chrome/120.0.0.0 Safari/537.36"
            )
        }  # Cabeceras simuladas

    def _obtener_html(self, url: str) -> BeautifulSoup:
        try:
            response = requests.get(url, headers=self.headers, timeout=10)
            response.raise_for_status()
            return BeautifulSoup(response.text, "html.parser")
        except requests.exceptions.RequestException as e:
            print(f"Error de red al acceder a {url}: {e}")
            raise

    def extraer_categorias(self) -> list:
        """Extrae un par de categorías para no sobrecargar el servidor en esta demo."""
        soup = self._obtener_html(self.base_url)
        categorias_html = soup.select(".side_categories ul li ul li a")

        datos_categorias = []
        for cat in categorias_html[:2]:  # Limitado a 2 para el ejemplo
            nombre = cat.text.strip()
            link = self.base_url + cat.get("href")
            datos_categorias.append({"nombre": nombre, "url": link})
        return datos_categorias

    def extraer_libros_de_categoria(
        self, categoria_url: str, categoria_id: int
    ) -> list:
        """Scraping profundo de los libros de una categoría."""
        soup = self._obtener_html(categoria_url)
        libros_html = soup.select("article.product_pod")

        objetos_libro = []
        for articulo in libros_html:
            try:
                titulo = articulo.select_one("h3 a").get("title")
                precio_raw = articulo.select_one(".price_color").text
                stock_raw = articulo.select_one(".instock.availability").text.strip()

                # Instanciación y validación del modelo
                libro = Libro(titulo, precio_raw, stock_raw, categoria_id)
                objetos_libro.append(libro)
            except (AttributeError, ValueError, TypeError) as e:
                print(f"Error parseando un libro: {e}")

        return objetos_libro
