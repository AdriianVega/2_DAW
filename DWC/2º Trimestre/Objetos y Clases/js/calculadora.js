// Clase para calculadora
class Calculadora {
    // Inicializamos con campo privado
    #resultado = 0;

    // Validamos que la entrada sea un número antes de sobreescribir el resultado
    set resultado(valor) {
        if (!Number.isFinite(valor)) {
            throw new ValueError("El valor debe ser un número finito");
        }
        this.#resultado = valor;
    }

    // Obtenemos el valor actual del resultado
    get obtenerResultado() {
        return this.#resultado;
    }

    // Validamos el valor y realizamos la suma al resultado
    sumar(valor) {
        if (!Number.isFinite(valor)) {
            throw new ValueError("El valor debe ser un número");
        }
        this.#resultado += valor;
    }

    // Validamos el valor y realizamos la resta al resultado
    restar(valor) {
        if (!Number.isFinite(valor)) {
            throw new ValueError("El valor debe ser un número");
        }
        this.#resultado -= valor;
    }
    
    // Validamos el valor y realizamos la multiplicación al resultado
    multiplicar(valor) {
        if (!Number.isFinite(valor)) {
            throw new ValueError("El valor debe ser un número");
        }
        this.#resultado *= valor;
    }

    // Validamos el valor y realizamos la división al resultado
    dividir(valor) {
        if (!Number.isFinite(valor)) {
            throw new ValueError("El valor debe ser un número");
        }
        else if (valor === 0) {
            throw new ValueError("No se puede dividir entre cero");
        }
        this.#resultado /= valor;
    }

    // Restablecemos el valor del resultado a 0
    reiniciar() {
        this.#resultado = 0;
    }
}

const calc = new Calculadora();

console.log("----------- CALCULADORA -------------")

calc.sumar(10);
console.log(calc.obtenerResultado);

calc.restar(5);
console.log(calc.obtenerResultado);

calc.multiplicar(3);
console.log(calc.obtenerResultado);

calc.dividir(5);
console.log(calc.obtenerResultado);

calc.reiniciar();
console.log(calc.obtenerResultado);

console.log("--------------------------------------")