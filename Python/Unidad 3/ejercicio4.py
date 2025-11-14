import json

persona = {
 "nombre": "Lucía",
 "edad": 30,
 "activo": True
}

with open("persona.json", "w", encoding="utf-8") as j:
    json.dump(persona, j, indent=4, ensure_ascii=False)
    
with open("persona.json", "r", encoding="utf-8") as j:
    contenido = json.load(j)
    
    print("Contenido:", contenido)
    