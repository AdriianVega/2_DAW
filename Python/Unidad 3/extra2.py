with open("original.jpg", "rb") as b:
    imagen_binario = b.read()
    
    with open("copia.jpg", "wb") as b:
        b.write(imagen_binario)
