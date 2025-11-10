import csv

with open("alumnos.csv", "r", encoding="utf-8") as c:
    lector = csv.reader(c)

    next(lector)

    for alumno, nota in lector:
        if (float(nota) >= 8):
            print(f"Alumno con buena nota: {alumno} ({nota})")