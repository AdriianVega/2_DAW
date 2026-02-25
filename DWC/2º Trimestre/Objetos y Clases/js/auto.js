// Clase para auto
class Auto {
    // Definimos estados iniciales
    encendido = false;
    velocidad = 0;

    // Inicializamos marca, modelo y patente
    constructor(marca, modelo, patente) {
        this.marca = marca;
        this.modelo = modelo;
        this.patente = patente;
    }

    // Arrancamos el auto
    arrancar() {
        this.encendido = true;
    }

    // Apagamos el auto validando primero
    apagar() {
        if (this.velocidad === 0) {
            this.encendido = false;
        }
    }

    // Aceleramos el auto validando primero
    acelerar() {
        if (this.encendido) {
            this.velocidad += 10;
        }
    }

    // Desaceleramos el auto validando primero
    desacelerar() {
        if (this.encendido && this.velocidad > 0) {
            this.velocidad -= 10;
        }
    }

    // Obtenemos la velocidad actual
    getVelocidad() {
        return this.velocidad;
    }

    // Pasamos los datos del auto a texto
    toString() {
        return `${this.marca} ${this.modelo}, patente ${this.patente}`;
    }
}

console.log("----------- AUTO -------------")

const miAuto = new Auto('Toyota', 2021, 'ABC123');
console.log(miAuto.toString());
miAuto.arrancar();
miAuto.acelerar();
console.log(miAuto.getVelocidad());
miAuto.desacelerar();
console.log(miAuto.getVelocidad());
miAuto.apagar();

console.log("------------------------------")
