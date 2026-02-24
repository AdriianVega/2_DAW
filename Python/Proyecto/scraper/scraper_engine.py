"""
Módulo de scraping.
"""
import requests

class WebScraper:
    """Realizamos peticiones HTTP simulando un navegador."""

    def __init__(self):
        """Configuramos cabeceras para evitar bloqueos antibot."""
        # Simulamos cabeceras completas de un navegador real para evitar bloqueos antibot
        self.headers = {
            "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 " +
            "(KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36",
            "Accept-Language": "es-ES,es;q=0.9,en;q=0.8",
            "Referer": "https://www.google.com/"
        }

    def obtener_html(self, url):
        """Realizamos la petición GET y retornamos el HTML"""
        response = requests.get(url, headers=self.headers, timeout=15)
        # Forzamos una excepción si el servidor devuelve un error HTTP (ej: 404, 500)
        response.raise_for_status()
        return response.text
