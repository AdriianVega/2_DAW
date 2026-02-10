"""
Docstring for Python.Unidad 7.SQLite y DAO.ejercicio_1
"""
import sqlite3
from clases.book import Book

conn = sqlite3.connect('data.db')

libro1 = Book('El Quijote', '19.99', True, 'https://example.com/quijote')

conn.execute('''DROP TABLE IF EXISTS books''')

conn.execute('''CREATE TABLE IF NOT EXISTS books (
                    id INTEGER PRIMARY KEY AUTOINCREMENT, 
                    titulo TEXT NOT NULL,
                    precio TEXT NOT NULL,
                    disponible BOOLEAN NOT NULL,
                    url TEXT NOT NULL
                )
            ''')

conn.execute('''INSERT INTO books (titulo, precio, disponible, url)
                VALUES (?, ?, ?, ?)''',
                (libro1.titulo, libro1.precio, libro1.disponible, libro1.url))

valores = conn.execute('SELECT * FROM books').fetchall()

for valor in valores:
    print(valor)

conn.commit()

conn.close()
