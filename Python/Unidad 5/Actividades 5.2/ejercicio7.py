from abc import ABC, abstractmethod

class Excursion(ABC):
    @abstractmethod
    def duracion(self):
        pass

class ExcursionPlaya(Excursion):
    def duracion(self):
        return "La duración de la excursión es de 3 horas"
    
class ExcursionMontanya(Excursion):
    def duracion(self):
        return "La duración de la excursión es de 5 horas"

excursion1 = ExcursionPlaya()
excursion2 = ExcursionMontanya()

print(excursion1.duracion())
print(excursion2.duracion())