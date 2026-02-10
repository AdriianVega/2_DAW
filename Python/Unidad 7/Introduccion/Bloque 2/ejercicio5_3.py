"""
Ejercicio 5_3
"""

import re

datos = {"producto": "Monitor", "precio": "abc", "stock": "-3", "email": "tienda@web"}

precio_valido = re.search(r"^\d+(\.\d+)?", datos["precio"])
stock_valido = re.search(r"^\d+", datos["stock"])
email_valido = re.search(r"[a-zA-Z\d._%]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}", datos["email"])

print("Errores encontrados:")

if not precio_valido:
    print("- El precio debe ser un número positivo")

if not stock_valido:
    print("- El stock debe ser un número positivo")

if not email_valido:
    print("- El email no es válido")
