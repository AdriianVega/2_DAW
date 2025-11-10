poema = [
    "La lentitud de los días",
    "",
    "El viento pasa y no deja huella,",
    "solo el rumor de las hojas cansadas,",
    "como si el bosque pensara en voz baja",
    "y cada rama guardara un secreto.",
    "",
    "El sol cae lento sobre la tarde,",
    "desliza su oro por los tejados,",
    "y el aire huele a pan y distancia,",
    "a algo que fue y que aún no termina.",
    "",
    "Camino despacio,",
    "como quien no busca nada",
    "pero teme perderlo todo.",
    "Las piedras del sendero",
    "me reconocen de otros pasos,",
    "de otras dudas, de antiguas despedidas.",
    "",
    "La vida —pienso— es un hilo leve,",
    "que se tensa con el miedo y la esperanza,",
    "y se enreda en las manos del tiempo",
    "cuando tratamos de atarlo al recuerdo.",
    "",
    "He visto rostros que se disuelven",
    "como tinta en el agua,",
    "nombres que fueron faros",
    "y hoy son niebla.",
    "He amado sin comprender",
    "y comprendido sin amar,",
    "y aún así, sigo caminando.",
    "",
    "Hay una belleza extraña en seguir,",
    "en no saber si el mar que oigo al fondo",
    "es promesa o despedida,",
    "si las olas llegan o se van.",
    "",
    "Y sin embargo, el horizonte insiste,",
    "la noche se abre como un libro nuevo,",
    "y las estrellas —esas pequeñas verdades—",
    "se encienden una a una,",
    "como si el universo también buscara sentido.",
    "",
    "Entonces callo,",
    "dejo que el silencio me enseñe,",
    "que la oscuridad me nombre,",
    "que el tiempo, por un instante,",
    "olvide que tiene prisa.",
    "",
    "Y así, mientras el mundo gira,",
    "mientras la luna lame el agua del río,",
    "yo sigo andando despacio,",
    "no hacia un lugar,",
    "sino hacia un momento",
    "en que todo —por fin—",
    "se entienda sin palabras."
]

with open("poema.txt", "w") as f:
    for verso in poema:
        f.write(verso + "\n")
        
with open("poema.txt", "r") as f:
    contenido = ""
    lineas = 0
    caracteres = 0
    palabras = 0
    
    for verso in f:
        verso_string = verso.strip()
        
        contenido += verso_string + "\n"
        
        if verso_string != "":
            lineas += 1
            caracteres += len(verso_string)
            palabras += len(verso_string.split())
            
    print(contenido + "\n")
    print(f"Líneas: {lineas}")
    print(f"Palabras: {palabras}")
    print(f"Caracteres: {caracteres}")