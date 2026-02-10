"""
Ejercicio 2_2
"""

from bs4 import BeautifulSoup
import re

HTML_DOC = """
    <html>
        <body>
            <ul id="catalogo">
                <li class="producto" data-id="A123" data-stock="25">
                    <span class="nombre">Teclado Mecánico</span>
                    <span class="precio">79.99€</span>
                </li>
            
                <li class="producto agotado" data-id="B450" data-stock="0">
                    <span class="nombre">Monitor 27"</span>
                    <span class="precio">229.50€</span>
                </li>
                
                <li class="producto" data-id="C777">
                    <span class="nombre">Ratón inalámbrico</span>
                    <span class="precio">34.95€</span>
                </li>
            </ul>
        </body>
    </html>
"""

soup = BeautifulSoup(HTML_DOC, "html.parser")

productos = soup.select("li.producto")
dicc_productos = []
dicc_precios = []

for producto in productos:
    id_producto = producto.get("data-id")
    stock = producto.get("data-stock")
    nombre = producto.select_one(".nombre").text
    precio = producto.select_one(".precio").text

    precio_formateado = re.sub(r"[,.€]", "", precio)

    dicc_productos.append(
        {
            "id": id_producto,
            "nombre": nombre,
            "precio": precio_formateado,
            "stock": stock or "Sin dato",
        }
    )

    dicc_precios.append({"id": float(precio_formateado)})

for producto in dicc_productos:
    if producto["stock"] != "Sin dato":
        print(f"{producto}")

print(dicc_precios)
