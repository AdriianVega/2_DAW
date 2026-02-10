"""
Docstring for Python.Unidad 7.SQLite y DAO.ejercicio_consolidacion_2
"""
import sqlite3

class Product:
    """
    Docstring for Product
    """
    def __init__(self, nombre, precio, stock, url):
        self.nombre = nombre
        self.precio = float(precio)
        self.stock = stock
        self.url = url

    def producto_economico(self):
        """
        Docstring for producto_economico
        """
        return self.precio < 30

class ProductDAO:
    """
    Docstring for ProductDAO
    """
    def __init__(self, db_path='data.db'):
        self.conn = sqlite3.connect(db_path)
        self.create_table()

    def create_table(self):
        """
        Docstring for create_table
        """
        self.conn.execute('''CREATE TABLE IF NOT EXISTS products (
                                id INTEGER PRIMARY KEY AUTOINCREMENT, 
                                nombre TEXT NOT NULL,
                                precio TEXT NOT NULL,
                                stock BOOLEAN NOT NULL,
                                url TEXT NOT NULL
                            )
        ''')
        self.conn.commit()

    def insert(self, product: Product):
        """
        Docstring for insert
        """
        self.conn.execute('''INSERT INTO products (nombre, precio, stock, url)
                            VALUES (?, ?, ?, ?)''',
                            (product.nombre, product.precio, product.stock, product.url))
        self.conn.commit()

    def bulk_insert(self, products):
        """
        Docstring for bulk_insert
        """
        self.conn.executemany('''INSERT INTO products (nombre, precio, stock, url)
                            VALUES (?, ?, ?, ?)''',
                            [(product.nombre,
                            product.precio,
                            product.stock,
                            product.url) for product in products])
        self.conn.commit()

    def select_all(self):
        """
        Docstring for select_all
        """
        return self.conn.execute('SELECT * FROM products').fetchall()

    def select_in_stock(self):
        """
        Docstring for select_in_stock
        """
        return self.conn.execute('SELECT * FROM products WHERE stock = 1').fetchall()
    

productos = [
    {
        "nombre": "Producto 1",
        "precio": "10.99",
        "stock": True,
        "url": "https://example.com/producto1"
    },
    {
        "nombre": "Producto 2",
        "precio": "15.99",
        "stock": False,
        "url": "https://example.com/producto2"
    },
    {
        "nombre": "Producto 3",
        "precio": "20.99",
        "stock": True,
        "url": "https://example.com/producto3"
    },
    {
        "nombre": "Producto 4",
        "precio": "25.99",
        "stock": True,
        "url": "https://example.com/producto4"
    },
    {
        "nombre": "Producto 5",
        "precio": "30.99",
        "stock": False,
        "url": "https://example.com/producto5"
    }
]

lista_productos = []

for producto in productos:
    p = Product(producto["nombre"], producto["precio"], producto["stock"], producto["url"])
    dao = ProductDAO()
    dao.insert(p)

    lista_productos.append(p)



print("\nProductos en stock:")
for producto in lista_productos:
    if producto.producto_economico() and producto.stock:
        print(f"\n{producto.nombre}")
        print(f"Precio: {producto.precio}")
        print(f"URL: {producto.url}")
