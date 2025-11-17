import json, os, csv

class Producto:
    def __init__(self, nombre, categoria, precio, stock):
        self.nombre = nombre
        self.categoria = categoria
        self.precio = precio
        self.stock = stock
        
    def to_dict(self):
        return {
            "nombre": self.nombre, "categoria": self.categoria,
            "precio": self.precio, "stock": self.stock
            }
        
electronica = [
    {"nombre": "Auriculares Bluetooth", "categoria": "electronica", "precio": 39.99, "stock": 120},
    {"nombre": "Teclado Mecánico", "categoria": "electronica", "precio": 79.50, "stock": 45},
    {"nombre": "Monitor 27 pulgadas", "categoria": "electronica", "precio": 189.90, "stock": 20},
    {"nombre": "Powerbank 20000mAh", "categoria": "electronica", "precio": 24.99, "stock": 300},
    {"nombre": "Ratón Inalámbrico", "categoria": "electronica", "precio": 14.95, "stock": 200}
]

alimentacion = [
    {"nombre": "Arroz basmati 1kg", "categoria": "alimentacion", "precio": 2.49, "stock": 500},
    {"nombre": "Pasta integral 500g", "categoria": "alimentacion", "precio": 1.35, "stock": 350},
    {"nombre": "Aceite de oliva 1L", "categoria": "alimentacion", "precio": 5.99, "stock": 120},
    {"nombre": "Garbanzos cocidos", "categoria": "alimentacion", "precio": 0.95, "stock": 220},
    {"nombre": "Café molido 250g", "categoria": "alimentacion", "precio": 3.75, "stock": 150}
]

hogar = [
    {"nombre": "Detergente 2L", "categoria": "hogar", "precio": 3.99, "stock": 90},
    {"nombre": "Estropajos pack 5", "categoria": "hogar", "precio": 1.20, "stock": 200},
    {"nombre": "Vela aromática", "categoria": "hogar", "precio": 4.50, "stock": 75},
    {"nombre": "Bayetas microfibra", "categoria": "hogar", "precio": 2.30, "stock": 150},
    {"nombre": "Ambientador eléctrico", "categoria": "hogar", "precio": 6.25, "stock": 60}
]

def crear_json(nombre, objetos):
    with open(f"{nombre}.json", "w", encoding="utf-8") as j:
        json.dump(objetos, j, indent=4, ensure_ascii=False)

crear_json("electronica", electronica)
crear_json("alimentacion", alimentacion)
crear_json("hogar", hogar)

productos = []
productos_objetos = []
productos_filtrados = []
media = 0

for archivo in os.listdir():
    if archivo.endswith(".json"):
        with open(archivo, "r", encoding="utf-8") as j:
            productos.extend(json.load(j))

for producto in productos:
    productos_objetos.append(Producto(producto["nombre"], producto["categoria"], producto["precio"], producto["stock"]))

for i, producto in enumerate(productos_objetos):
    producto_diccionario = producto.to_dict()
    
    media += producto_diccionario["precio"]
    
    if producto_diccionario["precio"] >= 50 and producto_diccionario["stock"] >= 10:
        productos_filtrados.append(producto)
        
    print(f"\nProducto {i + 1}:")
    
    for clave, valor in producto_diccionario.items():
        print(f"\t{clave.capitalize()}: {valor}")

print("\n------------------ PRODUCTOS FILTRADOS ------------------")

for i, producto in enumerate(productos_filtrados):
    
    print(f"\nProducto {i + 1}:")
    
    for clave, valor in producto_diccionario.items():
        print(f"\t{clave.capitalize()}: {valor}")
        
media = round(media / len(productos_objetos), 2)

print(f"\nMedia: {media}")

with open("productos_destacados.json", "w", encoding="utf-8") as j:
    productos_filtrados_dict = []
    
    for producto in productos_filtrados:
        productos_filtrados_dict.append(producto.to_dict())
        
    json.dump(productos_filtrados_dict, j, indent= 4, ensure_ascii= False)
    
with open("todos_productos.csv", "w", newline="", encoding="utf-8") as c:
    escritor = csv.writer(c)
    
    escritor.writerow(["Nombre", "Categoria", "Precio", "Stock"])
    
    for producto in productos_objetos:
        producto_dict = producto.to_dict()
        
        escritor.writerow([producto_dict["nombre"], producto_dict["categoria"], producto_dict["precio"], producto_dict["stock"]])

# Borrar archivos para .json para poder hacer pruebas, comentar si se quiere revisar los .json
for archivo in os.listdir():
    if archivo.endswith(".json"):
        os.remove(archivo)
