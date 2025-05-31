import React from 'react';

const Sejarah = () => {
  return (
    <div className="container py-5">
      <div className="row">
        <div className="col-lg-8 mx-auto">
          <h1 className="display-4 mb-4 text-center">Sejarah Kami</h1>
          
          <div className="timeline">
            <div className="timeline-item">
              <div className="timeline-badge bg-primary"></div>
              <div className="timeline-panel">
                <div className="timeline-heading">
                  <h4 className="timeline-title">Pendirian</h4>
                  <p><small className="text-muted">2023</small></p>
                </div>
                <div className="timeline-body">
                  <p>Perusahaan didirikan dengan visi untuk memberikan solusi terbaik.</p>
                </div>
              </div>
            </div>
            
            <div className="timeline-item">
              <div className="timeline-badge bg-success"></div>
              <div className="timeline-panel">
                <div className="timeline-heading">
                  <h4 className="timeline-title">Ekspansi Pertama</h4>
                  <p><small className="text-muted">2024</small></p>
                </div>
                <div className="timeline-body">
                  <p>Melakukan ekspansi pertama ke pasar internasional.</p>
                </div>
              </div>
            </div>
            
            <div className="timeline-item">
              <div className="timeline-badge bg-info"></div>
              <div className="timeline-panel">
                <div className="timeline-heading">
                  <h4 className="timeline-title">Pencapaian</h4>
                  <p><small className="text-muted">2025</small></p>
                </div>
                <div className="timeline-body">
                  <p>Mencapai 1000 klien dan mendapatkan penghargaan industri.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Sejarah;