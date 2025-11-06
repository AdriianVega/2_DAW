class Online:
    def tipo(self):
        return "La clase es presencial"
    
class Presencial:    
    def tipo(self):
        return "La clase es online"
    
class Ubicacion:
    def __init__(self, latitud, longitud):
        self.latitud = latitud
        self.longitud = longitud
    
    def mostrar_coordenadas(self):
        return f"\nX: {self.longitud}\nY: {self.latitud}"

class VisitaMixta(Online, Presencial):
    def __init__(self, nombre, ubicacion):
        self.nombre = nombre
        self.ubicacion = ubicacion
    
    def mostrar_info(self):
        print(f"Nombre de la visita: {self.nombre}\n")
        print(f"Las coordenadas son:{self.ubicacion.mostrar_coordenadas()}\n")
        print(super().tipo())

ub = Ubicacion(180, 173)

visita = VisitaMixta("Pedro", ub)

visita.mostrar_info()