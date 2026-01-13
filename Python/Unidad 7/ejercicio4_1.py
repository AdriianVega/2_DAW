"""
    Ejercicio 4_1
"""
import requests
from bs4 import BeautifulSoup

URL = "https://httpbin.org/headers"

headers = {
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)"
    "Chrome/120.0.0.0 Safari/537.36",
    "Accept-Language": "es-ES,es;q=0.9,en;q=0.8",
    "Referer": "https://www.google.com/"
}

try:
    response = requests.get(URL, headers=headers, timeout=30)
    response.raise_for_status()

    soup = BeautifulSoup(response.text, "html.parser")

    print(soup)

except requests.exceptions.RequestException as e:
    print(f"Error en la conexión: {e}")
