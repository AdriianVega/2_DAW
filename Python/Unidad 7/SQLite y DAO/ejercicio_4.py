"""
Docstring for Python.Unidad 7.SQLite y DAO.ejercicio_4
"""
import sqlite3

conn = sqlite3.connect('data.db')

conn.execute('''DROP TABLE IF EXISTS autores''')

conn.execute('''CREATE TABLE IF NOT EXISTS autores (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    nombre TEXT NOT NULL
                )
            ''')
conn.execute('''INSERT INTO autores (nombre) VALUES (?)''', ('Gabriel García Márquez',))

conn.execute('''DROP TABLE IF EXISTS books''')

conn.execute('''CREATE TABLE IF NOT EXISTS books (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    autor_id INTEGER NOT NULL,          
                    titulo TEXT NOT NULL,
                    precio TEXT NOT NULL,
                    disponible BOOLEAN NOT NULL,
                    url TEXT NOT NULL,
                    FOREIGN KEY (autor_id) REFERENCES autores(id)
                )
            ''')

conn.execute('''INSERT INTO books (autor_id, titulo, precio, disponible, url)
                VALUES (?, ?, ?, ?, ?)''',
                (1, 'Cien años de soledad', 25.99, True, 'https://example.com/soledad'))

libros = conn.execute('''SELECT * FROM books''').fetchall()

print(libros)

conn.commit()

conn.close()
