import React from 'react';

interface SiswaProps {
  nama: string;
  kelas: string;
  nis: string;
}

const Siswa: React.FC<SiswaProps> = ({ nama, kelas, nis }) => {
  return (
    <div className="container py-5">
      <div className="card">
        <div className="card-body">
          <h2 className="card-title">Detail Siswa</h2>
          <ul className="list-group list-group-flush">
            <li className="list-group-item">Nama: {nama}</li>
            <li className="list-group-item">Kelas: {kelas}</li>
            <li className="list-group-item">NIS: {nis}</li>
          </ul>
        </div>
      </div>
    </div>
  );
};

export default Siswa;