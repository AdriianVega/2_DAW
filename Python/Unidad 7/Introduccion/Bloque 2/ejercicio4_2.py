"""
Ejercicio 4_2
"""

import re

TEXTO = """
    === FICHA PERSONAL ===
    Nombre completo: María Gómez García
    Email de contacto: maria.gomez+work@example.co.uk
    Teléfonos: +34-600-123-456 / 600 777 888
    Dirección: Calle Falsa nº 123, 3ºB — Madrid (CP: 28080)
    Salario anual: 32.500 €
    Código interno: EMP-00AB-1299
"""

texto_limpio = re.sub(r"\s+", " ", TEXTO).strip()
nombre_completo = re.search(r"([^\W\d_]+\s){3}", texto_limpio)
email = re.search(r"[a-zA-Z\d._%]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}", texto_limpio)
telefono = re.search(r"\+\d{2}-\d{3}-\d{3}-\d{3}\s/\s\d{3}\s\d{3}\s\d{3}", texto_limpio)
direccion = re.search(
    r"[a-zA-Z]+\s[a-zA-Z]+\snº\s\d{3},\s\dº[A-Z]\s—\s[a-zA-Z]+\s\([A-Z]{2}:\s\d{5}\)",
    texto_limpio,
)
salario = re.search(r"\d+\.\d+\s€", texto_limpio)
codigo = re.search(r"[A-Z]{3}-\d{2}[A-Z]{2}-\d{4}", texto_limpio)

print(f"Texto limpio: {texto_limpio if texto_limpio else None}")

print(f"\nNombre completo: {nombre_completo.group() if nombre_completo else None}")

print(f"\nTeléfonos: {telefono.group() if telefono else None}")

print(f"\nDirección: {direccion.group() if direccion else None}")

print(f"\nSalario anual: {salario.group() if salario else None}")

print(f"\nCódigo interno: {codigo.group() if codigo else None}")
