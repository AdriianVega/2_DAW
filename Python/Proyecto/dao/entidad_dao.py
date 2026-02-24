"""
Módulo DAO.
Persistencia en SQLite.
"""
import sqlite3
from pathlib import Path

class BaseDAO:
    """Centralizamos la conexión y creación de tablas."""

    def __init__(self, db_name="scraper_data.db"):
        """Calculamos rutas y preparamos el entorno de base de datos."""
        # Calculamos rutas absolutas para evitar fallos si cambia el directorio de ejecución (CWD)
        directorio_dao = Path(__file__).parent
        directorio_data = directorio_dao.parent / "data"

        self.db_path = directorio_data / db_name
        self._crear_tablas()

    def _get_connection(self):
        """Conectamos a SQLite habilitando claves foráneas."""
        conn = sqlite3.connect(str(self.db_path))
        # Activamos las claves foráneas (apagadas por defecto en SQLite)
        conn.execute("PRAGMA foreign_keys = ON;")
        return conn

    def _crear_tablas(self):
        """Creamos las tablas si no existen."""
        with self._get_connection() as conn:
            conn.execute("""
                CREATE TABLE IF NOT EXISTS categorias (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    nombre TEXT UNIQUE NOT NULL,
                    url TEXT NOT NULL
                )
            """)
            conn.execute("""
                CREATE TABLE IF NOT EXISTS libros (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    titulo TEXT NOT NULL,
                    precio REAL NOT NULL,
                    en_stock BOOLEAN NOT NULL,
                    categoria_id INTEGER NOT NULL,
                    FOREIGN KEY(categoria_id) REFERENCES categorias(id)
                )
            """)
            conn.commit()


class CategoriaDAO(BaseDAO):
    """DAO para la entidad Categoría."""

    def insert(self, categoria):
        """Insertamos una categoría o recuperamos su ID existente."""
        with self._get_connection() as conn:
            cursor = conn.cursor()
            try:
                # Inyectamos valores con placeholders (?) para evitar inyección SQL
                cursor.execute(
                    "INSERT INTO categorias (nombre, url) VALUES (?, ?)",
                    (categoria.nombre, categoria.url),
                )
                conn.commit()

                # Devolvemos el ID de la categoría recién insertada
                return cursor.lastrowid

            except sqlite3.IntegrityError:
                # Si la categoría ya existe, recuperamos su ID original
                cursor.execute(
                    "SELECT id FROM categorias WHERE nombre = ?", (categoria.nombre,)
                )
                resultado = cursor.fetchone()
                return resultado[0] if resultado else None


class LibroDAO(BaseDAO):
    """DAO para la entidad Libro."""

    def bulk_insert(self, libros):
        """Realizamos una inserción masiva de libros."""
        if not libros:
            return

        with self._get_connection() as conn:
            datos = []

            for libro in libros:
                datos.append((libro.titulo, libro.precio, libro.en_stock, libro.categoria_id))

            # Usamos executemany para insertar el bloque entero de un solo golpe
            conn.executemany(
                "INSERT INTO libros (titulo, precio, en_stock, categoria_id) VALUES (?, ?, ?, ?)",
                datos
            )
            conn.commit()

    def select_all(self):
        """Recuperamos todos los libros."""
        with self._get_connection() as conn:
            return conn.execute("SELECT * FROM libros").fetchall()

    def select_filtered(self, max_precio):
        """Filtramos en base de datos libros en stock por precio."""
        with self._get_connection() as conn:
            return conn.execute(
                "SELECT titulo, precio FROM libros WHERE precio < ? AND en_stock = 1",
                (max_precio,),
            ).fetchall()
