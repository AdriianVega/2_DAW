"""
Docstring for Python.Unidad 7.SQLite y DAO.ejercicio_2
"""
import sqlite3
from clases.book import Book

libros = [
    Book('Cien años de soledad', 25.99, True, 'https://example.com/soledad'),
    Book('1984', 15.99, True, 'https://example.com/1984'),
    Book('El Gran Gatsby', 10.99, False, 'https://example.com/gatsby')
]

conn = sqlite3.connect('data.db')

conn.execute('''DROP TABLE IF EXISTS books''')

conn.execute('''CREATE TABLE IF NOT EXISTS books (
                    id INTEGER PRIMARY KEY AUTOINCREMENT, 
                    titulo TEXT NOT NULL,
                    precio TEXT NOT NULL,
                    disponible BOOLEAN NOT NULL,
                    url TEXT NOT NULL
                )
            ''')


for libro in libros:
    conn.execute('''INSERT INTO books (titulo, precio, disponible, url)
                    VALUES (?, ?, ?, ?)''',
                    (libro.titulo, libro.precio, libro.disponible, libro.url))

libros_disponibles = conn.execute('SELECT * FROM books WHERE disponible = 1').fetchall()

for libro in libros_disponibles:
    print(libro)

conn.commit()
conn.close()
