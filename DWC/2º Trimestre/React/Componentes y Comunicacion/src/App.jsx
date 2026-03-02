import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'
import Producto from './Producto'
import Carrito from './Carrito'

function App() {
  const [count, setCount] = useState(0)

  return (
    <>
      <Carrito />

      <h1>Listado de productos</h1>
      <Producto nombre="Camiseta" precio="19.99€">
        <p>Descripción de la camiseta</p>
      </Producto>

      <Producto nombre="Pantalón" precio="29.99€">
        <p>Descripción del pantalón</p>
      </Producto>
      
      <Producto nombre="Zapatos" precio="49.99€">
        <p>Descripción de los zapatos</p>
      </Producto>
    </>
  )
}

export default App
