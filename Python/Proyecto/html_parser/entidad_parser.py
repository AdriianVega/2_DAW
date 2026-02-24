"""
Módulo de parsing.
Extraemos datos del HTML crudo.
"""
from bs4 import BeautifulSoup

class WebParser:
    """Interpretamos el DOM mediante selectores CSS."""

    def parsear_categorias(self, html_content, base_url):
        """Extraemos categorías como lista de diccionarios."""
        soup = BeautifulSoup(html_content, "html.parser")
        # Localizamos los enlaces de categorías anidados en la barra lateral
        categorias_html = soup.select(".side_categories ul li ul li a")

        datos = []
        for categoria in categorias_html:
            datos.append({
                "nombre": categoria.text.strip(),
                "url": base_url + categoria.get("href")
            })
        return datos

    def parsear_libros(self, html_content):
        """Extraemos los datos crudos de los libros."""
        soup = BeautifulSoup(html_content, "html.parser")
        datos = []

        # Iteramos sobre cada tarjeta de producto de la página
        for articulo in soup.select("article.product_pod"):
            try:
                datos.append({
                    "titulo": articulo.select_one("h3 a").get("title"),
                    "precio": articulo.select_one(".price_color").text,
                    "stock": articulo.select_one(".instock.availability").text.strip()
                })
            except AttributeError:
                # Ignoramos productos con HTML incompleto
                continue
        return datos
