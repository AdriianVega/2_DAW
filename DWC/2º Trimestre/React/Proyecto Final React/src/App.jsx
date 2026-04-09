import { BrowserRouter, Routes, Route } from "react-router-dom";
import Navbar from "./components/Navbar";
import Productos from "./pages/Productos";
import DetalleProducto from "./pages/DetalleProducto";
import Sobre from "./pages/Sobre";
import "./App.css";

function App() {
  return (
    <BrowserRouter>
      <Navbar />
      <main className="container">
        <Routes>
          <Route path="/" element={<Productos />} />
          <Route path="/producto/:id" element={<DetalleProducto />} />
          <Route path="/sobre" element={<Sobre />} />
        </Routes>
      </main>
    </BrowserRouter>
  );
}

export default App;