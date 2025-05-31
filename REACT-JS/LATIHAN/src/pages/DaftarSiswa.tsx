import React from 'react';
import Siswa from './Siswa';

interface SiswaData {
  id: number;
  nama: string;
  kelas: string;
  nis: string;
}

interface DaftarSiswaProps {
  siswaList: SiswaData[];
}

const DaftarSiswa: React.FC<DaftarSiswaProps> = ({ siswaList }) => {
  return (
    <div className="container py-5">
      <h1 className="mb-4">Daftar Siswa</h1>
      <div className="row">
        {siswaList.map((siswa) => (
          <div key={siswa.id} className="col-md-4 mb-4">
            <Siswa 
              nama={siswa.nama} 
              kelas={siswa.kelas} 
              nis={siswa.nis} 
            />
          </div>
        ))}
      </div>
    </div>
  );
};

export default DaftarSiswa;