import json

persona = {
"nombre": "Lucía",
"edad": 30,
"activo": True
}

with open("persona.json", "w") as j:
    json.dump(persona, j, indent=4)
    
with open("persona.json", "r") as j:
    contenido = json.load(j)
    
    print("Contenido:", contenido)
    