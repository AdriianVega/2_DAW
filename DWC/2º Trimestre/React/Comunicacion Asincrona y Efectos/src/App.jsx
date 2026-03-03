import { useState } from 'react'
import './App.css'
import UsuariosAPI from './UsuariosAPI'

function App() {
  const [count, setCount] = useState(0)

  return (
    <>
      <UsuariosAPI />
    </>
  )
}

export default App
