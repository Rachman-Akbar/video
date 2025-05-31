import React from 'react';

const Kontak = () => {
  return (
    <div className="container py-5">
      <div className="row">
        <div className="col-lg-8 mx-auto">
          <h1 className="display-4 mb-4 text-center">Kontak Kami</h1>
          
          <div className="card mb-4">
            <div className="card-body">
              <h2 className="card-title">Informasi Kontak</h2>
              <ul className="list-unstyled">
                <li className="mb-2">
                  <i className="fas fa-envelope me-2"></i>
                  Email: info@example.com
                </li>
                <li className="mb-2">
                  <i className="fas fa-phone me-2"></i>
                  Telepon: 123-456-7890
                </li>
                <li>
                  <i className="fas fa-map-marker-alt me-2"></i>
                  Alamat: Jl. Contoh No. 123, Kota
                </li>
              </ul>
            </div>
          </div>
          
          <div className="card">
            <div className="card-body">
              <h2 className="card-title">Form Kontak</h2>
              <form>
                <div className="mb-3">
                  <label htmlFor="name" className="form-label">Nama</label>
                  <input type="text" className="form-control" id="name" required />
                </div>
                <div className="mb-3">
                  <label htmlFor="email" className="form-label">Email</label>
                  <input type="email" className="form-control" id="email" required />
                </div>
                <div className="mb-3">
                  <label htmlFor="message" className="form-label">Pesan</label>
                  <textarea className="form-control" id="message" rows={3} required></textarea>
                </div>
                <button type="submit" className="btn btn-primary">Kirim Pesan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Kontak;