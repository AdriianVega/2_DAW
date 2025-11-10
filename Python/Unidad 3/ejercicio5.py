import json

with open("persona.json", "r") as j:
    contenido = json.load(j)
    
    print(f"Nombre {contenido['nombre']} - Edad: {contenido['edad']}")