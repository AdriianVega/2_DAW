class ReservaHotel:
    agencia = "ViajesTorrevieja"
    
    def __init__(self, cliente, noches):
        self.cliente = cliente
        self.noches = noches
        
    def mostrar_reserva(self):
        print(f"Cliente: {self.cliente}")
        print(f"Nº noches: {self.noches}\n")
    
    @classmethod
    def mostrar_agencia(cls):
        print(f"Nombre de la agencia: {cls.agencia}\n")
    
    @staticmethod
    def mensaje_bienvenida():
        print("Bienvenido al sistema de reservas")
              
reserva1 = ReservaHotel("Juan Alberto", 8)
reserva2 = ReservaHotel("Pedro", 4)

reserva1.mostrar_reserva()
reserva2.mostrar_reserva()

reserva1.mostrar_agencia()
reserva2.mostrar_agencia()
              
ReservaHotel.mensaje_bienvenida()
