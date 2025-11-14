import os, json, csv

class Estudiante:
    def __init__(self, nombre, edad, nota, grupo):
        self.nombre = nombre
        self.edad = edad
        self.nota = nota
        self.grupo = grupo
        
    def to_dict(self):
        return {"nombre": self.nombre, "edad": self.edad, "nota": self.nota, "grupo":self.grupo}
    
estudiante1 = Estudiante("Pablo", 19, 8.7, "A")
estudiante2 = Estudiante("Pedro", 26, 2.3, "B")
estudiante3 = Estudiante("Marcos", 12, 4.3, "A")

estudiantes = []

estudiantes.append(estudiante1.to_dict())
estudiantes.append(estudiante2.to_dict())
estudiantes.append(estudiante3.to_dict())

for archivo in os.listdir():
    if archivo == "alumnos_extra.json":
        with open("alumnos_extra.json", "r", encoding="utf-8") as j:
            estudiantes.extend(json.load(j))

with open("alumnos.json", "w", encoding="utf-8") as j:
    json.dump(estudiantes, j, indent=4)

with open("alumnos.json", "r", encoding="utf-8") as j:
    alumnos = json.load(j)
    media = float(0)
    
    for i, alumno in enumerate(alumnos):
        print(f"Estudiante nº{i + 1}:\n Nombre: {alumno['nombre']}\n Edad: {alumno['edad']}\n Nota: {alumno['nota']}\n Grupo: {alumno['grupo']}\n")
        media += alumno["nota"]
        
    print("Estudiantes con notas >= 8:")
    
    for alumno in alumnos:
        if alumno["nota"] >= 8:
            print(f" Nombre: {alumno['nombre']}\n Edad: {alumno['edad']}\n Nota: {alumno['nota']}\n Grupo: {alumno['grupo']}\n")
    
media = round(media / len(estudiantes), 2)
    
print(f"\nLa nota media de los estudiantes es: {media}")
    
with open("alumnos_completo.csv", "w", newline="", encoding="utf-8") as c:
    escritor = csv.writer(c)
    
    escritor.writerow(["Nombre", "Edad", "Nota", "Grupo"])
    
    for estudiante in estudiantes:
        escritor.writerow([estudiante["nombre"], estudiante["edad"], estudiante["nota"], estudiante["grupo"]])