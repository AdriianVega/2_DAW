class ReservaHotel:
    agencia = "ViajesTorrevieja"
    __codigo_confirmacion = "RTe34LDQ"
    
    def __init__(self, cliente, noches):
        self.cliente = cliente
        self.noches = noches
        self._precio_total = 50 * self.noches
        
    def mostrar_reserva(self):
        print(f"Cliente: {self.cliente}")
        print(f"Nº noches: {self.noches}\n")
    
    @classmethod
    def mostrar_agencia(cls):
        print(f"Nombre de la agencia: {cls.agencia}\n")
    
    @staticmethod
    def mensaje_bienvenida():
        print("Bienvenido al sistema de reservas")
    
    def aplicar_descuento(self, codigo):
        if codigo == self.__codigo_confirmacion:
            self._precio_total -= self._precio_total  * 25 / 100
    
    @property
    def precio(self):
        return self._precio_total
    
    @precio.setter
    def precio(self, servicio):
        if servicio > 0:
            self._precio_total += servicio
        
reserva1 = ReservaHotel("Juan Alberto", 8)
reserva2 = ReservaHotel("Pedro", 4)

print(reserva1._precio_total)
# Warning: Access to a protected member _precio_total of a client class

# print(ReservaHotel.__codigo_confirmacion)
# AttributeError: 'ReservaHotel' object has no attribute '__codigo_confirmacion'

print(reserva2.precio)

reserva2.precio = 20
reserva2.precio = -13

print(reserva2.precio)

reserva1.aplicar_descuento("RTe34LDQ")

print(reserva1.precio)