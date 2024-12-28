import React from 'react';

const Achats = ({ achats }) => {
  return (
    <div style={{ fontFamily: '"Montserrat", sans-serif', padding: '2rem' }}>
      <h1>Mes Achats</h1>
      <p>Liste de tous vos achats passés.</p>

      {/* Vérification si l'utilisateur a des achats */}
      {achats.length === 0 ? (
        <p>Vous n'avez pas encore effectué d'achats.</p>
      ) : (
        <section style={productGridStyle}>
          {achats.map((achat) => (
            <div key={achat.id} style={productCardStyle}>
              <h2 style={productTitleStyle}>Commande #{achat.id}</h2>
              <p style={productDateStyle}>
                Date de commande: {new Date(achat.date_commande).toLocaleDateString()}
              </p>
              <p style={productTotalStyle}>Total: {achat.total} €</p>
              <p style={productStatusStyle}>
                Statut: {achat.statut === 1 ? 'Validée' : 'En attente'}
              </p>
            </div>
          ))}
        </section>
      )}
    </div>
  );
};

// Styles pour la page Achats
const productGridStyle = {
  display: 'grid',
  gridTemplateColumns: 'repeat(auto-fill, minmax(250px, 1fr))',
  gap: '1.5rem',
  marginTop: '2rem',
  padding: '0 2rem',
};

const productCardStyle = {
  backgroundColor: 'white',
  padding: '1rem',
  borderRadius: '8px',
  boxShadow: '0 2px 4px rgba(0, 0, 0, 0.1)',
  textAlign: 'center',
};

const productTitleStyle = {
  fontSize: '1.2rem',
  fontWeight: '600',
  color: '#4B0044',
  marginBottom: '0.5rem',
};

const productDateStyle = {
  fontSize: '1rem',
  color: '#666',
  marginBottom: '0.5rem',
};

const productTotalStyle = {
  fontSize: '1.2rem',
  fontWeight: '700',
  color: '#9C1D39', // Rouge brique pour l'accent
  marginBottom: '0.5rem',
};

const productStatusStyle = {
  fontSize: '1rem',
  fontWeight: '500',
  color: '#4B0044',
};

export default Achats;
