from bs4 import BeautifulSoup

HTML_DOC = """
    <html>
        <body>
            <div class="noticias">
                <article class="post destacado">
                    <h2>Economía en crecimiento</h2>
                    <p class="autor">Por Ana López</p>
                    <p class="contenido">El PIB aumentó un 3% durante el último trimestre.</p>
                </article>
                
                <article class="post">
                    <h2>Nuevo descubrimiento científico</h2>
                    <p class="autor">Por Dr. Martín Pérez</p>
                    <p class="contenido">Se encontró una nueva partícula subatómica.</p>
                </article>
                
                <article class="post destacado">
                    <h2>Innovación en IA</h2>
                    <p class="autor">Por Carla Ruiz</p>
                    <p class="contenido">La nueva tecnología revoluciona el sector.</p>
                </article>
            </div>
        </body>
    </html>
"""

soup = BeautifulSoup(HTML_DOC, "html.parser")

articulos_destacados = soup.select("article", class_ = "post destacado")

for articulo in articulos_destacados:
    titulo = articulo.select_one("h2")
    autor = articulo.select_one("p.autor")
    contenido = articulo.select_one("p.contenido")

    nombre_autor = autor.text.replace("Por ", "")

    recorte = int(len(contenido.text) * 0.15)

    print("\n------------------------------------------")
    print(f"Titulo: {titulo.text}")
    print(f"Autor: {nombre_autor}")
    print(f"Contenido 15%: {contenido.text[:recorte]}")
    print("------------------------------------------")

segundo_titulo = soup.select_one(".noticias article:nth-of-type(2) h2")

print(f"Segundo h2: {segundo_titulo.text}")

titulos = [titulo.text for titulo in soup.select(".noticias h2")]

titulos.sort()

print("\nTítulos ordenados alfábeticamente: ")

for i, titulo in enumerate(titulos):
    print(f"\tTitulo {i}: {titulo}")
