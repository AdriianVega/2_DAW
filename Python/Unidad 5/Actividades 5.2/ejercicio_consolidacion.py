from abc import ABC, abstractmethod

class ServicioTuristico(ABC):
    def __init__(self, nombre, precio):
        self._nombre = nombre
        self.__precio = precio
    
    @property
    def nombre(self):
        return self._nombre
    
    @nombre.setter
    def nombre(self, valor):
        self._nombre = valor
    
    @property
    def precio(self):
        return self.__precio
    
    @precio.setter
    def precio(self, valor):
        if valor > 0:
            self.__precio = valor
    
    def __str__(self):
        pass
    
    def __repr__(self):
        pass

    @abstractmethod
    def realizar_servicio(self):
        pass
    
class Excursion(ServicioTuristico):
    def __init__(self, nombre, precio, destino, duracion):
        super().__init__(nombre, precio)
        self.destino = destino
        self.duracion = duracion
    
    def realizar_servicio(self):
        print(f"Realizando excursión a {self.destino} durante {self.duracion} horas. ")
        
    def __str__(self):
        return (f"Nombre de la Excursion: {self.nombre}\n"
                f"Precio de la Excursion: {self.precio} €\n"
                f"Destino de la Excursion: {self.destino}\n"
                f"Duración de la Excursion: {self.duracion} horas")
    
    def __repr__(self):
        return (f"Excursion: {self.nombre}\n"
                f"Precio: {self.precio}\n"
                f"Destino: {self.destino}\n"
                f"Duración: {self.duracion}")

class Alojamiento(ServicioTuristico):
    def __init__(self, nombre, precio, nombre_hotel, estrellas):
        super().__init__(nombre, precio)
        self.nombre_hotel = nombre_hotel
        self.estrellas = estrellas
    
    def realizar_servicio(self):
        print(f"Reservando alojamiento {self.nombre} de {self.estrellas} estrellas.")
        
    def __str__(self):
        return (f"Nombre del Alojamiento: {self.nombre}\n"
                f"Precio del Alojamiento: {self.precio} €\n"
                f"Nombre del Hotel: {self.nombre_hotel}\n"
                f"Estrellas del Hotel: {self.estrellas}")
    
    def __repr__(self):
        return (f"Nombre: {self.nombre}\n"
                f"Precio: {self.precio}\n"
                f"Hotel: {self.nombre_hotel}\n"
                f"Estrellas: {self.estrellas}")


class Transporte(ServicioTuristico):
    def __init__(self, nombre, precio, tipo):
        super().__init__(nombre, precio)
        self.tipo = tipo
    
    def realizar_servicio(self):
        print(f"Transportando a los clientes en {self.tipo}.")
        
    def __str__(self):
        return (f"Nombre del Transporte: {self.nombre}\n"
                f"Precio del Transporte: {self.precio} €\n"
                f"Tipo de Transporte: {self.tipo}")
    
    def __repr__(self):
        return (f"Nombre: {self.nombre}\n"
                f"Precio: {self.precio}\n"
                f"Tipo: {self.tipo}")

class Agencia():
    def __init__(self, servicios):
        self.servicios = servicios
    
    def agregar_servicio(self, servicio):
        if isinstance(servicio, ServicioTuristico):
            self.servicios.append(servicio)

    def mostrar_servicios(self):
        for i, servicio in enumerate(self.servicios):
            print(f"\nServicio {i + 1}:")
            print(servicio.__str__())

def realizar_servicios(agencia_array):
    for i, servicio in enumerate(agencia_array.servicios):
        print(f"\nServicio {i + 1}:")
        servicio.realizar_servicio()

excursion1 = Excursion("Excursión al Museo", 50, "Museo del Prado", 3)
alojamiento1 = Alojamiento("Hotel Central", 120, "Hotel Central", 4)
transporte1 = Transporte("Bus Turístico", 30, "Autobús")

agencia = Agencia([])

agencia.agregar_servicio(excursion1)
agencia.agregar_servicio(alojamiento1)
agencia.agregar_servicio(transporte1)

agencia.mostrar_servicios()

realizar_servicios(agencia)

# print(f"Nombre del primer servicio (protegido): {excursion1._nombre}")
# Warning: Access to a protected member _nombre of a client class

# print(f"Precio del primer servicio (privado): {excursion1.__precio}")
# Error: Access to a protected member __precio of a client class

print("\nMÉTODOS ESPECIALES:")
print(str(alojamiento1))
print(repr(transporte1))