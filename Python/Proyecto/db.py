import sqlite3
from general import Categoria
class BaseDAO:
    """Clase base para manejar la conexión a SQLite."""

    def __init__(self, db_path="scraper_data.db"):
        self.db_path = db_path
        self._habilitar_foreign_keys()

    def _habilitar_foreign_keys(self):
        with sqlite3.connect(self.db_path) as conn:
            conn.execute("PRAGMA foreign_keys = ON;")


class CategoriaDAO(BaseDAO):
    """DAO para la entidad Categoría."""

    def __init__(self, db_path="scraper_data.db"):
        super().__init__(db_path)
        self.create_table()

    def create_table(self):
        """
        Docstring para create_table
        """
        with sqlite3.connect(self.db_path) as conn:
            conn.execute(
                """CREATE TABLE IF NOT EXISTS categorias (
                                id INTEGER PRIMARY KEY AUTOINCREMENT,
                                nombre TEXT UNIQUE NOT NULL,
                                url TEXT NOT NULL
                            )"""
            )

    def insert(self, categoria: Categoria) -> int:
        """Inserta una categoría y devuelve su ID usando placeholders."""
        with sqlite3.connect(self.db_path) as conn:
            cursor = conn.cursor()
            try:
                cursor.execute(
                    "INSERT INTO categorias (nombre, url) VALUES (?, ?)",
                    (categoria.nombre, categoria.url),
                )
                conn.commit()
                return cursor.lastrowid
            except sqlite3.IntegrityError:
                # Si existe, recupera el ID
                cursor.execute(
                    "SELECT id FROM categorias WHERE nombre = ?", (categoria.nombre,)
                )
                return cursor.fetchone()[0]


class LibroDAO(BaseDAO):
    """DAO para la entidad Libro."""

    def __init__(self, db_path="scraper_data.db"):
        super().__init__(db_path)
        self.create_table()

    def create_table(self):
        """
        Docstring para create_table
        """
        with sqlite3.connect(self.db_path) as conn:
            conn.execute(
                """CREATE TABLE IF NOT EXISTS libros (
                                id INTEGER PRIMARY KEY AUTOINCREMENT,
                                titulo TEXT NOT NULL,
                                precio REAL NOT NULL,
                                en_stock BOOLEAN NOT NULL,
                                categoria_id INTEGER NOT NULL,
                                FOREIGN KEY(categoria_id) REFERENCES categorias(id)
                            )"""
            )

    def bulk_insert(self, libros: list):
        """Inserción masiva de libros."""
        with sqlite3.connect(self.db_path) as conn:
            conn.executemany(
                """INSERT INTO libros (titulo, precio, en_stock, categoria_id)
                                VALUES (?, ?, ?, ?)""",
                [(l.titulo, l.precio, l.en_stock, l.categoria_id) for l in libros],
            )
            conn.commit()

    def select_all(self) -> list:
        """Recupera todos los registros."""
        with sqlite3.connect(self.db_path) as conn:
            return conn.execute("SELECT * FROM libros").fetchall()

    def select_filtered(self, max_precio: float) -> list:
        """Filtra libros por debajo de un precio específico."""
        with sqlite3.connect(self.db_path) as conn:
            return conn.execute(
                "SELECT titulo, precio FROM libros WHERE precio < ? AND en_stock = 1",
                (max_precio,),
            ).fetchall()
