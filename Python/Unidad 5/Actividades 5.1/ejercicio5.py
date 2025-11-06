class Alumno:
    def hablar(self):
        print("Tengo una duda.")

class Profesor:
    def hablar(self):
        print("Voy a explicar el tema.")

def hacer_hablar(persona):
    persona.hablar()

alumno1 = Alumno()
profesor1 = Profesor()

hacer_hablar(alumno1)
hacer_hablar(profesor1)
