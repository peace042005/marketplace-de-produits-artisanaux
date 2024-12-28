import React from 'react';

const Avis = ({ avis }) => {
    return (
        <div style={{ fontFamily: '"Montserrat", sans-serif', padding: '2rem' }}>
            <h1>Mes Avis</h1>
            <p>Liste de toutes tes avis passées.</p>

            {/* Vérification si l'utilisateur a laissé des avis */}
            {avis.length === 0 ? (
                <p>Vous n'avez pas encore laissé d'avis.</p>
            ) : (
                <section style={avisListStyle}>
                    {avis.map((avisItem) => (
                        <div key={avisItem.id} style={avisCardStyle}>
                            <p style={avisCommentStyle}>
                                <strong>Commentaire :</strong> {avisItem.commentaire}
                            </p>
                            <p style={avisDateStyle}>
                                Date de l'avis: {new Date(avisItem.date_avis).toLocaleDateString()}
                            </p>
                            <p style={avisRatingStyle}>
                                Note: {avisItem.note || 'Non attribuée'}
                            </p>
                        </div>
                    ))}
                </section>
            )}
        </div>
    );
};

// Styles pour les avis
const avisListStyle = {
    display: 'grid',
    gridTemplateColumns: 'repeat(auto-fill, minmax(250px, 1fr))',
    gap: '1.5rem',
    marginTop: '2rem',
    padding: '0 2rem',
};

const avisCardStyle = {
    backgroundColor: 'white',
    padding: '1rem',
    borderRadius: '8px',
    boxShadow: '0 2px 4px rgba(0, 0, 0, 0.1)',
    textAlign: 'center',
};

const avisCommentStyle = {
    fontSize: '1rem',
    color: '#666',
    marginBottom: '0.5rem',
};

const avisDateStyle = {
    fontSize: '1rem',
    color: '#999',
    marginBottom: '0.5rem',
};

const avisRatingStyle = {
    fontSize: '1rem',
    fontWeight: '500',
    color: '#4B0044',
};

export default Avis;
