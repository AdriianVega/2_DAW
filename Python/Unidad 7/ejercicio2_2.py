"""
    Ejercicio 2_2
"""
import json
import requests
from bs4 import BeautifulSoup

URL = "https://www.w3schools.com/html/html_links.asp"

try:
    response = requests.get(URL, timeout=10)
    soup = BeautifulSoup(response.text, "html.parser")

    enlaces = soup.find_all("a")
    diccionario_enlaces = []

    if enlaces:
        for enlace in enlaces:
            href = enlace.get('href')

            print(f"Texto: {enlace.text}\nEnlace: {href}\n")

            diccionario_enlaces.append({"texto": enlace.get_text(strip=True), "enlace": href})

        print(json.dumps(diccionario_enlaces, indent=4, ensure_ascii=False))

except requests.exceptions.RequestException as e:
    print(f"Ha ocurrido un error: {e}")
