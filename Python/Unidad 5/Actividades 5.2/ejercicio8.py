class PaqueteTuristico:
    def __init__(self, dias):
        self.dias = dias
    
    def __str__(self):
        clase = type(self).__name__
        return f"{clase} de {self.dias} días"
    
    def __repr__(self):
        clase = type(self).__name__
        return f"{clase}({self.dias})"
    
    def __eq__(self, paquete_turistico):
        if isinstance(paquete_turistico, PaqueteTuristico):
            return self.dias == paquete_turistico.dias
        return NotImplemented
    
    def __add__(self, paquete_turistico):
        if isinstance(paquete_turistico, PaqueteTuristico):
            if  paquete_turistico.dias > 0:
                return PaqueteTuristico(self.dias + paquete_turistico.dias)
        return NotImplemented
    
    def __sub__(self, paquete_turistico):
        if isinstance(paquete_turistico, PaqueteTuristico):
            return PaqueteTuristico(self.dias - paquete_turistico.dias)
        return NotImplemented
    
    def __lt__(self, paquete_turistico):
        if isinstance(paquete_turistico, PaqueteTuristico):
            return (paquete_turistico.dias < self.dias)
        return NotImplemented

p1 = PaqueteTuristico(5)
p2 = PaqueteTuristico(3)
p3 = PaqueteTuristico(5)

print("=== __str__ ===")
print(p1)

print("\n=== __repr__ ===")
print(repr(p1))

print("\n=== __eq__ ===")
print(p1 == p2)
print(p1 == p3)

print("\n=== __add__ ===")
try:
    print(p1 + p2)
except Exception as e:
    print("Error en __add__:", e)

print("\n=== __sub__ ===")
try:
    print(p1 - p2)
except Exception as e:
    print("Error en __sub__:", e)

print("\n=== __lt__ ===")
print(p1 < p2)
