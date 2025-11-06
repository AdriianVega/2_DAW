class GuiaTuristico:
    def __init__(self, nombre):
        self.nombre = nombre
        
    def hablar(self):
        return "Bienvenidos al tour"

class GuiaMuseo(GuiaTuristico):
    def __init__(self, nombre, idioma):
        super().__init__(nombre)
        self.idioma = idioma
    
    def hablar(self):
        return "Bienvenidos al tour del museo"
    
    def presentar(self):
        print(self.hablar())
        return(super().hablar())

guia = GuiaMuseo("Pedro", "Francés")

print(guia.presentar())