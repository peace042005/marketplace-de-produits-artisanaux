import React from 'react';

const Profil = ({ user }) => {
    // Styles pour la mise en page
    const containerStyle = {
        fontFamily: '"Montserrat", sans-serif',
        maxWidth: '800px',
        margin: '2rem auto',
        padding: '2rem',
        backgroundColor: '#fff',
        borderRadius: '8px',
        boxShadow: '0 4px 8px rgba(0, 0, 0, 0.1)',
    };

    const headerStyle = {
        display: 'flex',
        alignItems: 'center',
        marginBottom: '2rem',
    };

    const profileImageStyle = {
        width: '120px',
        height: '120px',
        borderRadius: '50%',
        objectFit: 'cover',
        border: '3px solid #FFD166',
        marginRight: '1.5rem',
    };

    const infoContainerStyle = {
        flex: 1,
    };

    const nameStyle = {
        fontSize: '1.8rem',
        fontWeight: '600',
        color: '#4B0044',
    };

    const subtitleStyle = {
        fontSize: '1rem',
        color: '#666',
        marginBottom: '1rem',
    };

    const sectionTitleStyle = {
        fontSize: '1.5rem',
        fontWeight: '600',
        marginTop: '2rem',
        color: '#4B0044',
    };

    const detailStyle = {
        fontSize: '1rem',
        color: '#333',
        marginBottom: '0.5rem',
    };

    return (
        <div style={containerStyle}>
            {/* En-tête du profil */}
            <div style={headerStyle}>
                <img
                    src={user.photo_profil || 'https://via.placeholder.com/120'}
                    alt="Photo de profil"
                    style={profileImageStyle}
                />
                <div style={infoContainerStyle}>
                    <h1 style={nameStyle}>{user.name} {user.prenom}</h1>
                    <p style={subtitleStyle}>{user.email}</p>
                </div>
            </div>

            {/* Section détails */}
            <h2 style={sectionTitleStyle}>Détails personnels</h2>
            <p style={detailStyle}><strong>Sexe :</strong> {user.sexe}</p>
            <p style={detailStyle}><strong>Téléphone :</strong> {user.telephone}</p>
            <p style={detailStyle}><strong>Adresse :</strong> {user.adresse || 'Non renseignée'}</p>
            <p style={detailStyle}><strong>Date de naissance :</strong> {user.date_naissance}</p>
            <p style={detailStyle}><strong>Poids :</strong> {user.poids ? `${user.poids} kg` : 'Non renseigné'}</p>
            <p style={detailStyle}><strong>Taille :</strong> {user.taille ? `${user.taille} cm` : 'Non renseignée'}</p>

            {/* Section biographie */}
            <h2 style={sectionTitleStyle}>Biographie</h2>
            <p style={detailStyle}>{user.biographie || 'Aucune biographie renseignée.'}</p>
        </div>
    );
};

export default Profil;
