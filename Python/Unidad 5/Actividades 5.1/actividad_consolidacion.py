class Libro:
    def __init__(self, titulo, autor):
        self.titulo = titulo
        self.autor = autor
        self.__prestado = False

    def prestar(self):
        if not self.__prestado:
            self.__prestado = True
            print(f"El libro {self.titulo} ha sido prestado.")
        else:
            print(f"El libro {self.titulo} ya está prestado.")

    def devolver(self):
        if self.__prestado:
            self.__prestado = False
            print(f"El libro {self.titulo} ha sido devuelto.")
        else:
            print(f"El libro {self.titulo} no estaba prestado.")


class Usuario:
    def __init__(self, nombre):
        self.nombre = nombre
        self.libros_prestados = []

    def tomar_libro(self, libro):
            libro.prestar()
            self.libros_prestados.append(libro)

    def devolver_libro(self, libro):
        if libro in self.libros_prestados:
            libro.devolver()
            self.libros_prestados.remove(libro)
        else:
            print(f"{self.nombre} no tiene el libro {libro.titulo}.")
            
class Bibliotecario(Usuario):
    def agregar_libro(self, libro):
        self.libros_prestados.append(libro)
        
        print(f"{self.nombre} ha añadido el libro {libro.titulo} a la colección de la biblioteca.")


class Invitado(Usuario):
    def tomar_libro(self, libro):
        if len(self.libros_prestados) >= 1:
            print(f"{self.nombre} solo puede tener un libro prestado a la vez.")
        else:
            super().tomar_libro(libro)


libro1 = Libro("1984", "George Orwell")
libro2 = Libro("Don Quijote", "Miguel de Cervantes")

bibliotecario = Bibliotecario("Laura")
usuario1 = Usuario("Carlos")
invitado1 = Invitado("Ana")

bibliotecario.agregar_libro(libro1)
bibliotecario.agregar_libro(libro2)

usuario1.tomar_libro(libro1)
invitado1.tomar_libro(libro2)
invitado1.tomar_libro(libro1)

print(f"Libros de {usuario1.nombre}:")
for libro in usuario1.libros_prestados:
    print(f" - {libro.titulo}")

print(f"\nLibros de {invitado1.nombre}:")
for libro in invitado1.libros_prestados:
    print(f" - {libro.titulo}")

print(f"\nColección de la biblioteca:")
for libro in bibliotecario.libros_prestados:
    print(f" - {libro.titulo}")
