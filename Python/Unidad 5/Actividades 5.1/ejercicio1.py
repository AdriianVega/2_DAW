class Libro():
    tipo = "Literatura"
    
    def __init__(self, titulo, autor):
        self.titulo = titulo
        self.autor = autor

libro1 = Libro("Cien años de soledad", "Gabriel García Márquez")

print("Título:", libro1.titulo)
print("Autor:", libro1.autor)