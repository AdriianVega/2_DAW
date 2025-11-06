class Persona:
    def __init__(self, nombre):
        self.nombre = nombre

    def presentarse(self):
        print(f"Hola, mi nombre es {self.nombre}.")

class Profesor(Persona):
    def ensenyar(self):
        print("Doy clase a mis alumnos.")

profesor1 = Profesor("Carlos")

profesor1.presentarse()
profesor1.ensenyar()
