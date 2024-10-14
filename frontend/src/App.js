import React from 'react';
import { Routes, Route } from 'react-router-dom';
import Navbar from './components/Navbar';
import Registration from './components/Registration';
import Search from './components/Search';
import './index.css';


function App() {
  return (
    <div>
      <Navbar />
      <Routes>
        <Route path="/" element={<Registration />} />
        <Route path="/search" element={<Search />} />
      </Routes>
    </div>
  );
}

export default App;
