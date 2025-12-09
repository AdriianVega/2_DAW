"""
    Ejercicio 1_2
"""
import json
import requests

URL = "https://www.httpbin.org/get"

try:
    response = requests.get(URL, timeout=10)
    response_json = response.json()

    print(f"Código de estado: {response.status_code}")

    if response.status_code == 200:
        print(f"Longitud del contenido: {len(response.text)}")
        print(
            f"Página en formato JSON: {json.dumps(response_json, indent=4, ensure_ascii=False)}"
        )
        print(f"Dirección IP: {response_json["origin"]}")
    else:
        print(f"Error al obtener la página: {response.status_code}")

except requests.exceptions.RequestException as e:
    print(f"Ha ocurrido un error: {e}")
