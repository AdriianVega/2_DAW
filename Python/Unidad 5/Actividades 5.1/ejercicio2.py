class Libro():
    tipo = "Literatura"
    
    def __init__(self, titulo, autor):
        self.titulo = titulo
        self.autor = autor
    
    def presentar(self):
        print(f"El libro {self.titulo} ha sido escrito por {self.autor}")

libro1 = Libro("Cien años de soledad", "Gabriel García Márquez")
libro2 = Libro("1984", "George Orwell")


print("Título:", libro1.titulo)
print("Autor:", libro1.autor)

libro1.presentar()
libro2.presentar()