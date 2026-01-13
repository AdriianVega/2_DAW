"""
    Ejercicio 3_3
"""

import requests
from bs4 import BeautifulSoup
import re

URL = "https://books.toscrape.com/catalogue/page-1.html"

headers = {
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)"
    "Chrome/120.0.0.0 Safari/537.36",
    "Accept-Language": "es-ES,es;q=0.9,en;q=0.8",
    "Referer": "https://www.google.com/",
}

try:
    datos = []
    libros_totales = 0

    while True:
        response = requests.get(URL, headers=headers,timeout=10)
        soup = BeautifulSoup(response.text, "html.parser")
        

        titulos = soup.find_all("a", attrs={"title": True})
        precios = soup.find_all("p", class_="price_color")
        num_estrellas = soup.find_all("p", class_= "star-rating")

        for titulo, precio, estrellas in zip(titulos, precios, num_estrellas):

            precio_limpio = re.sub(r"[Â\s]","", precio.text).strip()

            traduccion_estrellas = {"One": "Una", "Two": "Dos", "Three": "Tres", "Four": "Cuatro", "Five": "Cinco"}

            datos.append({"titulo": titulo.text,
                        "precio": precio_limpio,
                        "num_estrellas": traduccion_estrellas[estrellas.get("class")[1]]})
            
            libros_totales += 1
        
        siguiente_pagina = soup.find("li", class_="next")

        if not siguiente_pagina:
            break

        URL = f"https://books.toscrape.com/catalogue/{siguiente_pagina.find("a").get("href")}"
    
    for dato in datos:
            print(f"Titulo: {dato["titulo"]}\nPrecio: {dato["precio"]}\nNúmero de estrellas: {dato["num_estrellas"]}\n")

    print(f"Número total de libros: {libros_totales}")
    
except requests.exceptions.RequestException as e:
    print(f"Ha ocurrido un error: {e}")