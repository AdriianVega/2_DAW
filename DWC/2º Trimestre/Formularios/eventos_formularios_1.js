// Edita sólo este fichero

// Creamos una función general para generar los campos del formulario
function crearCampo(tipoCampo, idCampo, placeholderCampo) {
    
    // Creamos los elementos del campo
    let campo = document.createElement("div")
    let campoLabel = document.createElement("label");
    let campoInput = document.createElement("input")
    let divError = document.createElement("div")

    // Asignamos las clases y atributos
    campo.classList.add("form-group");
    campoInput.classList.add("form-control");
    divError.classList.add("invalid-feedback");

    campoLabel.setAttribute("for", idCampo);

    campoInput.setAttribute("type", tipoCampo);
    campoInput.setAttribute("name", idCampo);
    campoInput.setAttribute("placeholder", placeholderCampo);
    campoInput.setAttribute("id", idCampo);

    campoLabel.textContent = placeholderCampo;
    divError.textContent = "Campo requerido";

    // Añadimos los elementos al div principal
    campo.appendChild(campoLabel);
    campo.appendChild(campoInput);
    campo.appendChild(divError);

    return campo;
}

// Ejercicio 1

const formulario = document.getElementById("newEvent");
const nombre = document.getElementById("name");

// Creamos el campo de apellidos y lo insertamos
const apellidos = crearCampo("text", "surname", "Apellidos");

formulario.firstElementChild.after(apellidos);

const apellidosInput = document.getElementById("surname");

// Creamos en vez de formulario.addListenerEvenet(...) una función para juntar 
// todas las validaciones al final
function validarNombreYApellidos(foco) {

    // Añadimos el atributo required
    nombre.setAttribute("required", "");
    apellidosInput.setAttribute("required", "");

    // Comprobamos si falta el nombre
    if (nombre.validity.valueMissing) {

        // Añadimos la clase de error y guardamos el foco
        nombre.classList.add("is-invalid");

        // Esto significa si foco es igual a null o undefined asigna este valor
        foco ??= nombre;
    }
    else {
        nombre.classList.remove("is-invalid");    
    }

    // Comprobamos si falta el apellido
    if (apellidosInput.validity.valueMissing) {
        
        apellidosInput.classList.add("is-invalid");

        // Esto significa si foco es igual a null o undefined asigna este valor
        foco ??= apellidosInput;
    }
    else {
        apellidosInput.classList.remove("is-invalid");   
    }

    return foco;
}

// Ejercicio 2

// Creamos el campo edad y lo añadimos
const edad = crearCampo("number", "age", "Edad");

apellidos.after(edad);

const edadInput = document.getElementById("age");

function validarEdad(foco) {
    
    // Configuramos los límites de la edad
    edadInput.setAttribute("required", "");
    edadInput.setAttribute("min", "0");
    edadInput.setAttribute("max", "105");

    // Si es válido quitamos el error
    if (edadInput.validity.valid) {

        edadInput.classList.remove("is-invalid");
    }
    else {
        let edadError = edadInput.nextElementSibling;

        edadInput.classList.add("is-invalid");

        // Cambiamos el mensaje si está vacío o es inválido
        if (edadInput.validity.valueMissing) {

            edadError.textContent = "Campo requerido";
        }
        else {
            edadError.textContent = "Campo inválido"
        }
        foco ??= edadInput;
    }
    return foco
}

// Ejercicio 3

// Creamos el campo NIF
const nif = crearCampo("text", "nif", "NIF");

edad.after(nif);

const nifInput = document.getElementById("nif");

function validarNIF(foco) {

    nifInput.setAttribute("required", "");

    // ^ = Inicio de la cadena
    // \d = Números de 0 al 9
    // {8} = El patrón anterior se repite exactamente 8 veces
    // [A-Z] = El valor despues del guión es una letra en Mayúscula
    // $ = Fin de la cadena
    let expresion = /^\d{8}-[A-Z]$/
    let textoError = nifInput.nextElementSibling;

    // Comprobamos si cumple la expresión regular
    if (expresion.test(nifInput.value)) {
        
        nifInput.classList.remove("is-invalid");
    }
    else {
        nifInput.classList.add("is-invalid")

        if (!nifInput.validity.valueMissing) {

            textoError.textContent = "Campo inválido";
        }    

        foco ??= nifInput;
    }

    return foco;
}

// Ejercicio 4

// Creamos el campo email
const email = crearCampo("mail", "mail", "E-mail");

nif.after(email);

const emailInput = document.getElementById("mail");

function validarEmail(foco) {

    emailInput.setAttribute("required", "");

    // ^ = Inicio de la cadena
    // [a-zA-Z.]+ = Hay al menos una vez una letra del abecedario, ya sea en minúscula
    // o mayúscula o un punto (Lo añadí por que en gmail se pueden añadir puntos entre medias)
    // [a-z]+ = Después del arroba hay carácteres en minúscula desde la a a la z
    // \. = Hay un punto simple para especificar el dominio
    // [a-z]+ = Se vuelve a repetir el patron especificado anteriormente
    // $ = Fin de la cadena
    let expresion = /^[a-zA-Z.]+@[a-z]+\.[a-z]+$/;
    let textoError = emailInput.nextElementSibling;

    // Comprobamos el formato del email
    if (expresion.test(emailInput.value)) {
        
        emailInput.classList.remove("is-invalid");
    }
    else {
        emailInput.classList.add("is-invalid")

        if (!emailInput.validity.valueMissing) {

            textoError.textContent = "Campo inválido";
        }    

        foco ??= emailInput;
    }
    
    return foco
}

// Ejercicio 5

// Creamos los elementos para el select de provincia
const provincia = document.createElement("div")
let provinciaLabel = document.createElement("label")
let provinciaSelect = document.createElement("select")
let provinciaError = document.createElement("div")
let opcionDefault = document.createElement("option")
let opcion1 = document.createElement("option")
let opcion2 = document.createElement("option")

// Asignamos las clases
provincia.classList.add("form-group")
provinciaSelect.classList.add("form-control")
provinciaError.classList.add("invalid-feedback")

// Asignamos los atributos
provinciaLabel.setAttribute("for", "province")
provinciaSelect.setAttribute("name", "province")
provinciaSelect.setAttribute("id", "province")

provinciaLabel.textContent = "Provincia"
provinciaError.textContent = "Campo requerido"

// Configuramos las opciones
opcionDefault.textContent = "Selecciona una provincia"
opcionDefault.setAttribute("value", "")

opcion1.textContent = "Alicante"
opcion1.setAttribute("value", "alicante")

opcion2.textContent = "Valencia"
opcion2.setAttribute("value", "valencia")

// Añadimos las opciones al select
provinciaSelect.appendChild(opcionDefault)
provinciaSelect.appendChild(opcion1)
provinciaSelect.appendChild(opcion2)

provincia.appendChild(provinciaLabel)
provincia.appendChild(provinciaSelect)
provincia.appendChild(provinciaError)

email.after(provincia)

const provinciaInput = document.getElementById("province")

function validarProvincia(foco) {

    provinciaInput.setAttribute("required", "")

    // Comprobamos si se ha seleccionado una opción
    if (provinciaInput.validity.valueMissing) {

        provinciaInput.classList.add("is-invalid")

        foco ??= provinciaInput
    }
    else {
        provinciaInput.classList.remove("is-invalid")
    }

    return foco
}

// Ejercicio 6

// Creamos los radio buttons para el sexo
const sexo = document.createElement("div")
let sexoLabel = document.createElement("label")
let divRadios = document.createElement("div")
let radioHombre = document.createElement("input")
let labelHombre = document.createElement("label")
let radioMujer = document.createElement("input")
let labelMujer = document.createElement("label")
let sexoError = document.createElement("div")

sexo.classList.add("form-group")
sexoError.classList.add("invalid-feedback")

sexoLabel.textContent = "Sexo"
sexoError.textContent = "Campo requerido"

// Configuramos los atributos de los radios
radioHombre.setAttribute("type", "radio")
radioHombre.setAttribute("name", "sex")
radioHombre.setAttribute("value", "male")
radioHombre.setAttribute("id", "sexMale")

labelHombre.setAttribute("for", "sexMale")
labelHombre.textContent = "Hombre "

radioMujer.setAttribute("type", "radio")
radioMujer.setAttribute("name", "sex")
radioMujer.setAttribute("value", "female")
radioMujer.setAttribute("id", "sexFemale")

labelMujer.setAttribute("for", "sexFemale")
labelMujer.textContent = "Mujer"

divRadios.appendChild(radioHombre)
divRadios.appendChild(labelHombre)
divRadios.appendChild(radioMujer)
divRadios.appendChild(labelMujer)

sexo.appendChild(sexoLabel)
sexo.appendChild(divRadios)
sexo.appendChild(sexoError)

provincia.after(sexo)

const radiosSexo = document.getElementsByName("sex")

function validarSexo(foco) {

    let seleccionado = false
    
    // Recorremos los radios para ver si hay alguno marcado
    for (let radio of radiosSexo) {
        
        if (radio.checked) {
            
            seleccionado = true
            break
        }
    }

    if (seleccionado) {
        // Quitamos el error
        radioHombre.classList.remove("is-invalid")
        radioMujer.classList.remove("is-invalid")
        
        // Escondemos el error manualmente
        sexoError.style.display = "none"
    } 
    else {
        // Ponemos el error
        radioHombre.classList.add("is-invalid")
        radioMujer.classList.add("is-invalid")
        
        // Mostramos el error manualmente
        sexoError.style.display = "block"
        
        foco ??= radioHombre; 
    }

    return foco
}

// Ejercicio 7

const fechaInput = document.getElementById("date")
const fecha = fechaInput.parentElement 

// Cambiamos el tipo a texto
fechaInput.setAttribute("type", "text");

function validarFecha(foco) {

    fechaInput.setAttribute("required", "")

    // ^ = Inicio de la cadena
    // 0[1-9] = 0 y posteriormente un número del 1 al 9
    // | = usado para referirse a que se puede cumplir un patrón u otro
    // [12]\d = Pueden ser del 10 al 19 o del 20 al 29
    // | = usado para referirse a que se puede cumplir un patrón u otro
    // 3[01] = o 30 o 31
    // [-/] = se puede separar entre guiones o barras
    // 0[1-9] = 0 y posteriormente un número del 1 al 9
    // | = usado para referirse a que se puede cumplir un patrón u otro
    // 1[012] = 1 y posteriormente 0, 1 o 2
    // [-/] = se puede separar entre guiones o barras
    // \d{4} = 4 dígitos del 1 al 9
    // $ = Fin de la cadena
    let expresion = /^(0[1-9]|[12]\d|3[01])[-/](0[1-9]|1[012])[-/]\d{4}$/
    let textoError = fechaInput.nextElementSibling

    // Validamos el formato de la fecha
    if (expresion.test(fechaInput.value)) {
        
        fechaInput.classList.remove("is-invalid")
    }
    else {
        fechaInput.classList.add("is-invalid")

        if (fechaInput.validity.valueMissing) {

            textoError.textContent = "Campo requerido"
            
        } 
        else {
            textoError.textContent = "Campo inválido"
        }

        foco ??= fechaInput
    }

    return foco
}

// Ejercicio 8

// Creamos el campo teléfono
const telefono = crearCampo("text", "phone", "Teléfono")

fecha.after(telefono)

const telefonoInput = document.getElementById("phone")

function validarTelefono(foco) {

    telefonoInput.setAttribute("required", "")

    // ^ = Inicio de la cadena
    // [679] = un número que puede ser 6, 7 o 9
    // \d{8} = ocho numeros entre 1 y 9 
    // $ = Fin de la cadena
    let expresion = /^[679]\d{8}$/
    let textoError = telefonoInput.nextElementSibling

    // Comprobamos el patrón
    if (expresion.test(telefonoInput.value)) {
        
        telefonoInput.classList.remove("is-invalid")
    }
    else {
        telefonoInput.classList.add("is-invalid")

        if (telefonoInput.validity.valueMissing) {
            
            textoError.textContent = "Campo requerido"
        } 
        else {
            textoError.textContent = "Campo inválido"
        }

        foco ??= telefonoInput
    }

    return foco
}

// Ejercicio 9

// Creamos el campo hora
const hora = crearCampo("text", "time", "Hora")

telefono.after(hora)

const horaInput = document.getElementById("time")

function validarHora(foco) {

    horaInput.setAttribute("required", "")

    // ^ = Inicio de la cadena
    // [01] = o 0 o 1
    // \d = un dígito entre 1 y 9
    // | = usado para referirse a que se puede cumplir un patrón u otro
    // 2[0-3] = Un número comenzado por dos y otro dígito entr 0 y 3
    // : = Separador de la hora
    // [0-5] = Número entre 0 y 5
    // \d = un dígito entre 1 y 9
    // $ = Fin de la cadena
    let expresion = /^([01]\d|2[0-3]):[0-5]\d$/
    let textoError = horaInput.nextElementSibling

    // Validamos la hora
    if (expresion.test(horaInput.value)) {
        
        horaInput.classList.remove("is-invalid")
    }
    else {
        horaInput.classList.add("is-invalid")

        if (horaInput.validity.valueMissing) {
            
            textoError.textContent = "Campo requerido"
        } 
        else {
            textoError.textContent = "Campo inválido"
        }

        foco ??= horaInput
    }

    return foco
}

// Juntamos todas las validaciones en un mismo evento
formulario.addEventListener("submit", function (e) {
    
    let foco = null

    //Creamos un array y guardamos todas las validaciones
    // Si guardamos las funciones sin () no se ejecutan automáticamente
    let validaciones = [
        validarNombreYApellidos,
        validarEdad,
        validarNIF,
        validarEmail,
        validarProvincia,
        validarSexo,
        validarFecha,
        validarTelefono,
        validarHora
    ]

    //Prevenimos que se envie el formulario
    e.preventDefault()

    //Recorremos todas las validaciones pasando el resultado del foco anterior
    //Hacemos esto para que el foco lo tenga el primer elemento que dió error
    for (let validacion of validaciones) {

        foco = validacion(foco);
    }

    // Si hay error hacemos focus, si no enviamos
    if (foco) {
        
        foco.focus()
    }
    else
    {
        formulario.submit()
    }
})