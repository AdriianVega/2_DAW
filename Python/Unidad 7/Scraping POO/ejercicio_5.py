"""
Docstring para Python.Unidad 7.Scraping POO.ejercicio_5
"""

class Product:
    """
    Docstring para Product
    """

    def __init__(self, nombre, precio, stock, url):
        self.nombre = nombre
        self.precio = precio
        self.stock = stock
        self.url = url

    def is_in_stock(self):
        """Método para verificar si el producto está en stock."""
        return self.stock > 0

diccionario_producto = [
    {
        "nombre": "Camiseta",
        "precio": 19.99,
        "stock": 10,
        "url": "http://ejemplo.com/camiseta"
    },
    {
        "nombre": "Pantalón",
        "precio": 39.99,
        "stock": 0,
        "url": "http://ejemplo.com/pantalon"
    },
    {
        "nombre": "Zapatos",
        "precio": 59.99,
        "stock": 5,
        "url": "http://ejemplo.com/zapatos"
    }
]

for data in diccionario_producto:
    producto = Product(
        nombre=data["nombre"],
        precio=data["precio"],
        stock=data["stock"],
        url=data["url"]
    )
    if producto.is_in_stock():
        print(f"Producto: {producto.nombre}, Precio: {producto.precio}, URL: {producto.url}")
