"""
Proyecto Final Python
"""
import re



# ==========================================
# 1. MODELOS DE DOMINIO
# ==========================================


class Categoria:
    """Modelo para la entidad Categoría."""

    def __init__(self, nombre: str, url: str, categoria_id: int = None):
        self.id = categoria_id
        self.nombre = nombre.strip()
        self.url = url.strip()
        self._validar()

    def _validar(self):
        if not self.nombre or not self.url:
            raise ValueError("El nombre y la URL de la categoría son obligatorios.")

    def __str__(self):
        return f"Categoría: {self.nombre}"

    def __repr__(self):
        return f"Categoria(id={self.id}, nombre='{self.nombre}', url='{self.url}')"


class Libro:
    """Modelo para la entidad Libro, con relación a Categoría."""

    def __init__(
        self,
        titulo: str,
        precio_raw: str,
        stock_raw: str,
        categoria_id: int,
        libro_id: int = None,
    ):
        self.id = libro_id
        self.titulo = titulo.strip()
        self.precio = self._limpiar_precio(precio_raw)
        self.en_stock = self._verificar_stock(stock_raw)
        self.categoria_id = categoria_id
        self._validar()

    def _limpiar_precio(self, precio_str: str) -> float:
        """Uso de RegEx para limpiar el precio extraído."""
        match = re.search(r"\d+\.\d+", precio_str)
        if match:
            return float(match.group(0))
        raise ValueError(f"Formato de precio inválido: {precio_str}")

    def _verificar_stock(self, stock_str: str) -> bool:
        return "in stock" in stock_str.lower()

    def _validar(self):
        if not self.titulo or self.precio <= 0 or not self.categoria_id:
            raise ValueError("Datos del libro inválidos o incompletos.")

    def __str__(self):
        stock_str = "Sí" if self.en_stock else "No"
        return f"Libro: {self.titulo} | Precio: {self.precio}£ | Stock: {stock_str}"

    def __repr__(self):
        return (
            f"Libro(id={self.id}, titulo='{self.titulo}', "
            f"precio={self.precio}, stock={self.en_stock}, "
            f"cat_id={self.categoria_id})"
        )


# ==========================================
# 2. CAPA DE PERSISTENCIA (DAO)
# ==========================================


