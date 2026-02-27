const formulario = document.getElementById("formulario");

const character = {
    nombre: nombreInput,
    casa: casaInput,
    patronus: patronusInput,
    fechaNacimiento: fechaInput,
    sangre: sangreInput,
    varita: varitaInput
}

formulario.addEventListener("submit", async function(e) {
        e.preventDefault();

        const nombreInput = document.getElementById("nombre").value;
        const casaInput = document.getElementById("casa").value;
        const patronusInput = document.getElementById("patronus").value;
        const fechaInput = document.getElementById("fechaNacimiento").value;
        const sangreInput = document.getElementById("sangre").value;
        const varitaInput = document.getElementById("varitaInput").value;

        const character = {
            nombre: nombreInput,
            casa: casaInput,
            patronus: patronusInput,
            fechaNacimiento: fechaInput,
            sangre: sangreInput,
            varita: varitaInput
        }

        const res = await fetch("https://localhost:5001/personajes",  {
            method: "POST",
            headers: {
                'Content-Type': "application/json",
            },
            body: JSON.stringify(character)
        })
            
        const data = await res.json;
        localStorage.setItem("data", data.token)
})

