"""
    Ejercicio 2_1
"""
import requests
from bs4 import BeautifulSoup

URL = "https://www.w3schools.com/html/html_intro.asp"

try:
    response = requests.get(URL, timeout=10)
    response.raise_for_status()

    soup = BeautifulSoup(response.text, "html.parser")

    title_tag = soup.find("title")
    if title_tag:
        print(f"Título de la página: {title_tag.text}")

    first_paragraphs = first_paragraphs = soup.find_all("p")[:3]

    if first_paragraphs:
        print(f"Primer párrafo: {first_paragraphs[0].text}")

        print("Primeros párrafos: \n")

        for parrafo in first_paragraphs:
            print(parrafo.text)

except requests.exceptions.RequestException as e:
    print(f"Error en la conexión: {e}")
