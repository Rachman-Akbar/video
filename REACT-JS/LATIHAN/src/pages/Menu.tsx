import React from 'react';
import Tabel from './Tabel';

interface MenuItem {
  id: number;
  name: string;
  description: string;
  price: number;
  category: string;
}

export const menuItems: MenuItem[] = [
  { id: 1, name: 'Nasi Goreng', description: 'Nasi goreng spesial dengan telur dan ayam', price: 25000, category: 'Makanan' },
  { id: 2, name: 'Mie Goreng', description: 'Mie goreng dengan sayuran dan daging', price: 20000, category: 'Makanan' },
  { id: 3, name: 'Es Teh', description: 'Es teh manis segar', price: 5000, category: 'Minuman' },
  { id: 4, name: 'Es Jeruk', description: 'Es jeruk asli', price: 8000, category: 'Minuman' },
];

const Menu: React.FC = () => {

  return (
    <Tabel items={menuItems} />
  );
};

export default Menu;