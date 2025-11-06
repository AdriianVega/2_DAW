class AulaVirtual:
    def __init__(self, alumnos):
        self.__alumnos = alumnos

    def iniciar_clase(self):
        print(f"La clase ha comenzado con {self.__alumnos} alumnos.")

    def inscribir_alumnos(self, nuevos):
        self.__alumnos += nuevos

    def numero_alumnos(self):
        print(f"Número actual de alumnos inscritos: {self.__alumnos}")


aula1 = AulaVirtual(20)

aula1.iniciar_clase()
aula1.inscribir_alumnos(5)
aula1.numero_alumnos()

