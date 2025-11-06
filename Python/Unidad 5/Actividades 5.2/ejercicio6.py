class Transporte:
    def salir(self):
        return "El transporte está saliendo."

class AutobusTuristico(Transporte):
    def salir(self):
        return "El autobús está saliendo."

class BarcoExcursion(Transporte):
    def salir(self):
        return "El barco está saliendo."
    
def iniciar_viaje(transporte):
    print(transporte.salir())

iniciar_viaje(Transporte())
iniciar_viaje(AutobusTuristico())
iniciar_viaje(BarcoExcursion())