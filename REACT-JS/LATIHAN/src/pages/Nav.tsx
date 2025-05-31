import React from 'react';
import { Link } from 'react-router-dom';

const Nav = () => {
  return (
    <nav className="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
      <div className="container">
        <Link className="navbar-brand" to="/">
          <img src="/vite.svg" alt="Logo Perusahaan" width="40" className="me-2" />
          Nama Perusahaan
        </Link>
        
        <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span className="navbar-toggler-icon"></span>
        </button>
        
        <div className="collapse navbar-collapse" id="navbarNav">
          <ul className="navbar-nav ms-auto">
            <li className="nav-item">
              <Link className="nav-link" to="/">
                <i className="fas fa-home me-1"></i> Home
              </Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/tentang">
                <i className="fas fa-info-circle me-1"></i> Tentang
              </Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/sejarah">
                <i className="fas fa-history me-1"></i> Sejarah
              </Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/kontak">
                <i className="fas fa-envelope me-1"></i> Kontak
              </Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/menu">
                <i className="fas fa-utensils me-1"></i> Menu
              </Link>
            </li>
            <li className="nav-item dropdown">
              <a className="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                <i className="fas fa-users me-1"></i> Siswa
              </a>
              <ul className="dropdown-menu">
                <li>
                  <Link className="dropdown-item" to="/siswa">
                    <i className="fas fa-user me-1"></i> Detail Siswa
                  </Link>
                </li>
                <li>
                  <Link className="dropdown-item" to="/daftar-siswa">
                    <i className="fas fa-list me-1"></i> Daftar Siswa
                  </Link>
                </li>
                <li>
                  <Link className="dropdown-item" to="/list-siswa">
                    <i className="fas fa-table me-1"></i> List Siswa
                  </Link>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  );
};

export default Nav;