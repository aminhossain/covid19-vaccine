import React, { useState, useEffect } from 'react';
import axios from '../axios';

const Registration = () => {
    const [formData, setFormData] = useState({
        nid: '',
        name: '',
        email: '',         // Added email field
        date: '',          // Added date field
        vaccine_center_id: '',
    });
    
    const [centers, setCenters] = useState([]);
    const [loading, setLoading] = useState(false);
    const [message, setMessage] = useState('');
    const [error, setError] = useState('');

    // Fetch vaccine centers from backend API
    useEffect(() => {
        axios.get('/api/vaccine-centers')
            .then(response => setCenters(response.data))
            .catch(error => setError('Failed to load vaccine centers'));
    }, []);

    const handleChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        setError('');
        setMessage('');

        try {
            const response = await axios.post('/api/register', formData);
            setMessage(response.data.message);
        } catch (error) {
            setError(error.response.data.message || 'Registration failed');
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="container mt-5">
            <h2 className="mb-4">COVID Vaccine Registration</h2>
            {message && <div className="alert alert-success">{message}</div>}
            {error && <div className="alert alert-danger">{error}</div>}

            <form onSubmit={handleSubmit}>
                <div className="mb-3">
                    <label htmlFor="nid" className="form-label">National ID</label>
                    <input
                        type="text"
                        className="form-control"
                        id="nid"
                        name="nid"
                        value={formData.nid}
                        onChange={handleChange}
                        required
                    />
                </div>

                <div className="mb-3">
                    <label htmlFor="name" className="form-label">Name</label>
                    <input
                        type="text"
                        className="form-control"
                        id="name"
                        name="name"
                        value={formData.name}
                        onChange={handleChange}
                        required
                    />
                </div>

                {/* New Email Field */}
                <div className="mb-3">
                    <label htmlFor="email" className="form-label">Email</label>
                    <input
                        type="email"
                        className="form-control"
                        id="email"
                        name="email"
                        value={formData.email}
                        onChange={handleChange}
                        required
                    />
                </div>

                {/* New Date Field */}
                <div className="mb-3">
                    <label htmlFor="date" className="form-label">Preferred Vaccination Date</label>
                    <input
                        type="date"
                        className="form-control"
                        id="date"
                        name="date"
                        value={formData.date}
                        onChange={handleChange}
                        required
                    />
                </div>

                <div className="mb-3">
                    <label htmlFor="vaccine_center_id" className="form-label">Select Vaccine Center</label>
                    <select
                        className="form-control"
                        id="vaccine_center_id"
                        name="vaccine_center_id"
                        value={formData.vaccine_center_id}
                        onChange={handleChange}
                        required
                    >
                        <option value="">Choose a center</option>
                        {centers.map(center => (
                            <option key={center.id} value={center.id}>{center.name}</option>
                        ))}
                    </select>
                </div>

                <button type="submit" className="btn btn-primary" disabled={loading}>
                    {loading ? 'Submitting...' : 'Register'}
                </button>
            </form>
        </div>
    );
};

export default Registration;
