"""
Ejercicio 3.1
"""

import requests
from bs4 import BeautifulSoup

URL = "https://news.ycombinator.com/"

headers = {
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)"
    "Chrome/120.0.0.0 Safari/537.36",
    "Accept-Language": "es-ES,es;q=0.9,en;q=0.8",
    "Referer": "https://www.google.com/"
}

try:
    response = requests.get(URL, headers=headers, timeout=10)
    response.raise_for_status()

    soup = BeautifulSoup(response.text, "html.parser")

    titulos = soup.find_all("span", class_="titleline")
    titulos_enlaces = []

    for titulo in titulos:
        enlace = titulo.find("a")

        titulos_enlaces.append({"titulo": enlace.text, "enlace": enlace.get('href')})

    for titulo in titulos_enlaces:
        print(titulo)

except requests.exceptions.RequestException as e:
    print(f"Ha ocurrido un error: {e}")
