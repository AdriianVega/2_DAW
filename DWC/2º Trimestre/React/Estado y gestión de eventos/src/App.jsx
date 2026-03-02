import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'
import Carrito from './Carrito'

function App() {
  const [count, setCount] = useState(0)

  return (
    <>
      <Carrito />
    </>
  )
}

export default App
