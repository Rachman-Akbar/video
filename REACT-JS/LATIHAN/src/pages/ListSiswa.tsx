import React from 'react';

interface SiswaData {
  id: number;
  nama: string;
  kelas: string;
  nis: string;
}

interface ListSiswaProps {
  siswaData: SiswaData[];
  onDelete?: (id: number) => void;
}

const ListSiswa: React.FC<ListSiswaProps> = ({ siswaData, onDelete }) => {
  return (
    <div className="container py-5">
      <h1 className="mb-4">List Siswa</h1>
      <table className="table table-striped table-hover">
        <thead>
          <tr>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            {onDelete && <th>Aksi</th>}
          </tr>
        </thead>
        <tbody>
          {siswaData.map((siswa) => (
            <tr key={siswa.id}>
              <td>{siswa.nis}</td>
              <td>{siswa.nama}</td>
              <td>{siswa.kelas}</td>
              {onDelete && (
                <td>
                  <button 
                    className="btn btn-danger btn-sm"
                    onClick={() => onDelete(siswa.id)}
                  >
                    Hapus
                  </button>
                </td>
              )}
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default ListSiswa;