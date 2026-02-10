"""
Docstring for Python.Unidad 7.SQLite y DAO.ejercicio5
"""
import sqlite3

class Author:
    """
    Docstring for Author
    """
    def __init__(self, author_id, name):
        self.book_id = author_id
        self.name = name

class Book:
    """
    Docstring for Book
    """
    def __init__(self, book_id, titulo, precio, author_id):
        self.book_id = book_id
        self.titulo = titulo
        self.precio = precio
        self.author_id = author_id


cursor = sqlite3.connect('data.db').cursor()

cursor.execute('''INSERT INTO autores (nombre) VALUES (?)''', ('Gabriel García Márquez',))

cursor.execute('''INSERT INTO books (autor_id, titulo, precio, disponible, url)
                VALUES (?, ?, ?, ?, ?)''',
                (1, 'Cien años de soledad', 25.99, True, 'https://example.com/soledad'))

cursor.execute("SELECT id, titulo, precio, autor_id FROM books")

columnas = cursor.fetchall()

libros = []

for columna in columnas:
    libro = Book(columna[0], columna[1], columna[2], columna[3])
    libros.append(libro)

for libro in libros:
    print(libro.titulo)
    print(libro.precio)
    print(libro.author_id)
