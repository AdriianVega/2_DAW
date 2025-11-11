import json, csv

empleados = [
    {"id": 1, "nombre": "Ana García", "departamento": "Ventas", "salario": 25100.50},
    {"id": 2, "nombre": "Jorge Pérez", "departamento": "Marketing", "salario": 28300.75},
    {"id": 3, "nombre": "Marta López", "departamento": "Recursos Humanos", "salario": 30500.00},
    {"id": 4, "nombre": "Luis Torres", "departamento": "IT", "salario": 32700.40},
    {"id": 5, "nombre": "Clara Ruiz", "departamento": "Finanzas", "salario": 31900.60}
]
salario_medio = 0.0

with open("empleados.json", "w", encoding="utf-8") as j:
    json.dump(empleados, j, indent=4, ensure_ascii=False)
    
with open("empleados.json", "r", encoding="utf-8") as j:
    empleados_json = json.load(j)
    
    with open("empleados.csv", "w", newline="", encoding="utf-8") as c:
        escritor = csv.writer(c)
        datos = ["id", "nombre", "departamento", "salario"]
        
        escritor.writerow(datos)
        
        for empleado in empleados_json:
            datos_empleado = []
            
            for dato in datos:
                datos_empleado.append(empleado[dato])
            
            escritor.writerow(datos_empleado)

with open("empleados.csv", "r", encoding="utf-8") as c:
    lector = csv.reader(c)
    
    
    next(lector)
    
    print("Empleados con salario mayor a 30.000€: ")
    
    for empleado in lector:
        salario_medio += float(empleado[3])
        
        if (float(empleado[3]) > 30000):
            print(f"{empleado[1]}: {empleado[3]}€")
            
    salario_medio = round((salario_medio / 5), 2)
    
    print("Salario medio: ", salario_medio)

with open("empleados.csv", "r", encoding="utf-8") as c:
    lector = csv.DictReader(c)
    empleados_destacados = []
    
    with open("empleados_destacados.json", "w", encoding="utf-8") as j:
        for empleado in lector:
            if float(empleado["salario"]) > 30000:
                empleados_destacados.append(empleado)

        json.dump(empleados_destacados, j, indent=4, ensure_ascii=False)

with open("resumen.csv", "w", newline="", encoding="utf-8") as c:
    escritor = csv.writer(c)
    
    escritor.writerow(["Métrica", "Valor"])
    escritor.writerow(["Total empleados", len(empleados)])
    escritor.writerow(["Salario medio", salario_medio])        