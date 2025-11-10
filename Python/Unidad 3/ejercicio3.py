with open("log.txt", "w") as f:
    f.write("Inicio del registro")
    
with open ("log.txt", "a") as f:
    f.write("\nSegunda línea del registro")

with open ("log.txt", "r") as f:
    contenido = f.read()
    
    print("Contenido:\n", contenido)