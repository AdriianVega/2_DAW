"""
    Ejercicio 1_1
"""
import requests

URL = "https://www.httpbin.org/html"

try:
    response = requests.get(URL, timeout=10)

    if response.status_code == 200:
        texto = response.text[:500]

        print("Solicitud existosa. Contenido HTML")
        print(texto)

        print(f"Cantidad de veces que sale Herman: {texto.count("Herman")}")
    else:
        print(f"Error: Error al obtener la página ({response.status_code})")
except requests.exceptions.RequestException as e:
    print(f"Error: Ocurrió un error de conexión: {e}")
