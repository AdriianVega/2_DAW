"""
Ejercicio 5_2
"""
import re

correos = ["ana@gmail.com", "pepe@email", "juan@empresa.org", "correo@dominio"]
correos_validos = []
correos_invalidos = []

PATRON = r"^[a-zA-Z\d._%]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$"

print("Correos válidos:")

for correo in correos:
    if re.search(PATRON, correo):
        correos_validos.append(correo)

        print(f"{correo}")
    else:
        correos_invalidos.append(correo)


print("\nCorreos inválidos:")

for correo in correos_invalidos:
    if not re.search(PATRON, correo):
        print(f"{correo}")
