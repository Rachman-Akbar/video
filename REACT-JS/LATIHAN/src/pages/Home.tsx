import React from 'react';

const Home = () => {
  return (
    <div className="container py-5">
      <div className="row justify-content-center">
        <div className="col-md-8 text-center">
          <h1 className="display-4 mb-4">Selamat Datang</h1>
          <p className="lead">Ini adalah halaman utama aplikasi kami.</p>
          
          <div className="row mt-5">
            <div className="col-md-4 mb-4">
              <div className="card h-100">
                <div className="card-body">
                  <h5 className="card-title">Fitur 1</h5>
                  <p className="card-text">Deskripsi singkat fitur pertama.</p>
                </div>
              </div>
            </div>
            
            <div className="col-md-4 mb-4">
              <div className="card h-100">
                <div className="card-body">
                  <h5 className="card-title">Fitur 2</h5>
                  <p className="card-text">Deskripsi singkat fitur kedua.</p>
                </div>
              </div>
            </div>
            
            <div className="col-md-4 mb-4">
              <div className="card h-100">
                <div className="card-body">
                  <h5 className="card-title">Fitur 3</h5>
                  <p className="card-text">Deskripsi singkat fitur ketiga.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Home;