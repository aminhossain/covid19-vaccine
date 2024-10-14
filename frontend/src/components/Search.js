import React, { useState } from 'react';
import axios from '../axios';

const Search = () => {
    const [nid, setNid] = useState('');
    const [status, setStatus] = useState(null);
    const [error, setError] = useState(null);

    const handleSearch = async (e) => {
        e.preventDefault();
        try {
            const response = await axios.get(`/api/search?nid=${nid}`);
            setStatus(response.data);
            setError(null); // Clear any previous error
        } catch (err) {
            setError('No data found or an error occurred. Please try again.');
            setStatus(null); // Clear any previous status
        }
    };

    return (
        <div className="container mt-5">
            <h2>Check Vaccination Status</h2>
            <form onSubmit={handleSearch} className="mb-3">
                <label htmlFor="nid" className="form-label">Enter your NID:</label>
                <input
                    type="text"
                    id="nid"
                    className="form-control"
                    value={nid}
                    onChange={(e) => setNid(e.target.value)}
                    required
                />
                <button type="submit" className="btn btn-primary mt-3">Search</button>
            </form>

            {error && <div className="alert alert-danger">{error}</div>}
            {status && (
                <div className="alert alert-info">
                    <h5>Status: {status.status}</h5>
                    {status.message && <p>{status.message}</p>}
                    {status.scheduled_date && <p>Scheduled Date: {status.scheduled_date}</p>}
                </div>
            )}
        </div>
    );
};

export default Search;
