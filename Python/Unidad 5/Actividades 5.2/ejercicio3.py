class Habitacion:
    _precio_noche = 30
    
    def __init__(self, nombre, noches):
        self.precio_total = Habitacion._precio_noche * noches
        self.nombre = nombre
        self.noches = noches
    
    @property
    def precio_noche(self):
        return Habitacion._precio_noche
    
    @precio_noche.setter
    def precio_noche(self, suma_precio_noche):
        if suma_precio_noche > 0:
            Habitacion._precio_noche += suma_precio_noche
    
    @precio_noche.deleter
    def precio_noche(self):
        del Habitacion._precio_noche
    
habitacion1 = Habitacion("Pedro", 8)

print(habitacion1.precio_noche)

habitacion1.precio_noche = 20

print(habitacion1.precio_noche)

habitacion1.precio_noche = -20

print(habitacion1.precio_noche)

del habitacion1.precio_noche

# print(habitacion1.precio_noche)
# AttributeError: type object 'Habitacion' has no attribute '_precio_noche'