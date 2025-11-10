import csv

with open("alumnos.csv", "w", newline='', encoding='utf-8') as c:
    escritor = csv.writer(c)
    
    escritor.writerow(["nombre", "nota"])
    escritor.writerow(["Ana", 8.5])
    escritor.writerow(["Jorge", 6.0])
    escritor.writerow(["Marta", 9.2])
    
with open("alumnos.csv", "r", encoding='utf-8') as c:
    lector = csv.reader(c)
    next(lector)
    for nombre, nota in lector:
        print(f"{nombre}: {nota}")