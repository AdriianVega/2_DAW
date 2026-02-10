"""
Ejercicio 3_2
"""
from bs4 import BeautifulSoup

HTML_DOC = """
    <ul>
        <li class="producto">Teclado - 19.99 €</li>
        <li class="producto">Ratón - 12.50 €</li>
        <li class="producto">Monitor - 179.00 €</li>
    </ul>
"""

soup = BeautifulSoup(HTML_DOC, "html.parser")

def parsear_productos(def_soup):
    """Parsea el objeto soup y retorna una lista de diccionarios"""
    lista_productos = []

    productos = def_soup.select("li.producto")

    for producto in productos:
        nombre, precio = list(map(str.strip, producto.text.split("-")))

        lista_productos.append((nombre, precio))

    return lista_productos

productos_parseados = parsear_productos(soup)

print("\n", productos_parseados)
