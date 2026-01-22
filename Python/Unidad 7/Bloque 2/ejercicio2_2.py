from bs4 import BeautifulSoup

HTML_DOC = """
    <html>
        <body>
            <ul id="catalogo">
                <li class="producto" data-id="A123" data-stock="25">
                    <span class="nombre">Teclado Mecánico</span>
                    <span class="precio">79.99€</span>
                </li>
            
                <li class="producto agotado" data-id="B450" data-stock="0">
                    <span class="nombre">Monitor 27"</span>
                    <span class="precio">229.50€</span>
                </li>
                
                <li class="producto" data-id="C777">
                    <span class="nombre">Ratón inalámbrico</span>
                    <span class="precio">34.95€</span>
                </li>
            </ul>
        </body>
    </html>
"""

soup = BeautifulSoup(HTML_DOC, "html.parser")
    
