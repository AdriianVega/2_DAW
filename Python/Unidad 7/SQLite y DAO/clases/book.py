"""
Docstring for Python.Unidad 7.SQLite y DAO.clases.book"""
import sqlite3

class Book:
    """
    Docstring for Book
    """
    def __init__(self, titulo, precio, disponible, url):
        self.titulo = titulo
        self.precio = precio
        self.disponible = disponible
        self.url = url
class BookDAO:
    """
    Docstring for BookDAO
    """
    def __init__(self, db_path='data.db'):
        self.conn = sqlite3.connect(db_path)
        self.create_table()


    def create_table(self):
        """
        Docstring for create_table
        """
        self.conn.execute('''CREATE TABLE IF NOT EXISTS books (
                                id INTEGER PRIMARY KEY AUTOINCREMENT, 
                                titulo TEXT NOT NULL,
                                precio TEXT NOT NULL,
                                disponible BOOLEAN NOT NULL,
                                url TEXT NOT NULL
                            )
        ''')
        self.conn.commit()

    def insert(self, book: Book):
        """
        Docstring for insert
        """
        self.conn.execute('''INSERT INTO books (titulo, precio, disponible, url)
                            VALUES (?, ?, ?, ?)''',
                            (book.titulo, book.precio, book.disponible, book.url))
        self.conn.commit()

    def select_all(self):
        """
        Docstring for select_all
        """
        return self.conn.execute('SELECT * FROM books').fetchall()
