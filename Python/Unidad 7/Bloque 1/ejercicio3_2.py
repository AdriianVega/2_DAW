"""
Ejercicio 3.2
"""

import requests
from bs4 import BeautifulSoup

URL = "https://www.worldometers.info/coronavirus/"

headers = {
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)"
    "Chrome/120.0.0.0 Safari/537.36",
    "Accept-Language": "es-ES,es;q=0.9,en;q=0.8",
    "Referer": "https://www.google.com/",
}

try:
    response = requests.get(URL, headers=headers, timeout=10)
    response.raise_for_status()

    soup = BeautifulSoup(response.text, "html.parser")

    tabla = soup.find("table", id="main_table_countries_today").find("tbody")
    filas = tabla.find_all("tr")

    datos = []

    for fila in filas:
        if fila.get("style") != "display: none":
            columnas = fila.find_all("td")

            datos.append(
                {
                    "pais": columnas[1].get_text(strip=True),
                    "casos_totales": columnas[2].get_text(strip=True) or "N/A",
                    "total_muertes": columnas[4].get_text(strip=True) or "N/A",
                    "total_recuperados": columnas[6].get_text(strip=True) or "N/A",
                }
            )

    print(f"\n{"País":25}{"Casos Totales":15}{"Muertes":15}{"Recuperados":15}")

    for dato in datos:
        print(
            f"{dato["pais"]:25}"
            f"{dato["casos_totales"]:15}"
            f"{dato["total_muertes"]:15}"
            f"{dato["total_recuperados"]:15}"
        )

except requests.exceptions.RequestException as e:
    print(f"Ha ocurrido un error: {e}")
