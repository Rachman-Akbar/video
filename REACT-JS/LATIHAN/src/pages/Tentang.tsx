import React from 'react';

const Tentang = () => {
  return (
    <div className="container py-5">
      <div className="row">
        <div className="col-lg-8 mx-auto">
          <h1 className="display-4 mb-4 text-center">Tentang Kami</h1>
          
          <div className="card mb-4">
            <div className="card-body">
              <h2 className="card-title">Visi Kami</h2>
              <p className="card-text">Menjadi penyedia solusi terdepan di industri kami.</p>
            </div>
          </div>
          
          <div className="card mb-4">
            <div className="card-body">
              <h2 className="card-title">Misi Kami</h2>
              <p className="card-text">Memberikan layanan terbaik dengan tim profesional yang berdedikasi.</p>
            </div>
          </div>
          
          <div className="card">
            <div className="card-body">
              <h2 className="card-title">Tim Kami</h2>
              <p className="card-text">Tim berpengalaman siap membantu Anda mencapai tujuan bisnis.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Tentang;