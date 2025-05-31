import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'

import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import './index.css';

import Nav from './pages/Nav';
import Home from './pages/Home';
import Tentang from './pages/Tentang';
import Sejarah from './pages/Sejarah';
import Kontak from './pages/Kontak';
import Siswa from './pages/Siswa';
import DaftarSiswa from './pages/DaftarSiswa';
import ListSiswa from './pages/ListSiswa';
import Menu from './pages/Menu';

// Initialize Font Awesome library
library.add(fas);

function App() {
  return (
    <Router>
      <div className="App">
        <Nav />
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/tentang" element={<Tentang />} />
          <Route path="/sejarah" element={<Sejarah />} />
          <Route path="/kontak" element={<Kontak />} />
          <Route path="/siswa" element={<Siswa nama="John Doe" kelas="12 IPA" nis="12345" />} />
          <Route path="/daftar-siswa" element={
            <DaftarSiswa siswaList={[
              { id: 1, nama: 'John Doe', kelas: '12 IPA', nis: '12345' },
              { id: 2, nama: 'Jane Smith', kelas: '12 IPS', nis: '12346' },
              { id: 3, nama: 'Bob Johnson', kelas: '11 IPA', nis: '12347' }
            ]} />
          } />
          <Route path="/list-siswa" element={
            <ListSiswa siswaData={[
              { id: 1, nama: 'John Doe', kelas: '12 IPA', nis: '12345' },
              { id: 2, nama: 'Jane Smith', kelas: '12 IPS', nis: '12346' },
              { id: 3, nama: 'Bob Johnson', kelas: '11 IPA', nis: '12347' }
            ]} />
          } />
          <Route path="/menu" element={<Menu />} />
          </Routes>
      </div>
    </Router>
  );
}

export default App
