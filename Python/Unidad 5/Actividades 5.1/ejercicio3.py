class Biblioteca:
    def __init__(self, num_libros):
        self.__num_libros = num_libros

    def ver_num_libros(self):
        return self.__num_libros

    def agregar_libros(self, cantidad):
        self.__num_libros += cantidad


biblio1 = Biblioteca(100)

print("Número total de libros:", biblio1.ver_num_libros())

biblio1.agregar_libros(50)

print("Número total de libros:", biblio1.ver_num_libros())
