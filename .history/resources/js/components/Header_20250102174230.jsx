import React from 'react';
import { Link } from 'react-router-dom'; // Utilisation de react-router-dom pour la navigation

const Header = () => {
    // Utiliser useLocation pour obtenir l'URL actuelle
    const currentPage = window.location.pathname;

    // Styles
    const headerStyle = {
        backgroundColor: '#FFD166', // Jaune moutarde
        color: 'white',
        padding: '1rem 2rem',
        boxShadow: '0 2px 4px rgba(0, 0, 0, 0.1)',
    };

    const navStyle = {
        display: 'flex',
        justifyContent: 'space-between',
        alignItems: 'center',
    };

    const ulStyle = {
        listStyle: 'none',
        display: 'flex',
        gap: '2rem',
        margin: 0,
        padding: 0,
    };

    const linkStyle = {
        textDecoration: 'none',
        color: '#4B0044',
        fontSize: '1.2rem',
        fontWeight: '500',
        transition: 'color 0.3s ease, border-bottom 0.3s ease',
        fontFamily: '"Montserrat", sans-serif',
        paddingBottom: '0.2rem', // Juste un peu de padding pour l'effet de bordure
    };

    const activeLinkStyle = {
        color: '#9C1D39', // Couleur du lien actif
        fontWeight: '700',
        borderBottom: '2px solid #9C1D39', // Souligné pour l'élément actif
    };

    const linkHoverStyle = '#9C1D39';

    // Fonction pour vérifier si la route est active
    const isActive = (route) => {
        return currentPage === route;
    };

    return (
        <header style={headerStyle}>
            <nav style={navStyle}>
                {/* Logo */}
                <div style={{ fontSize: '2rem', fontWeight: 'bold', fontFamily: '"Montserrat", sans-serif' }}>
                    <span style={{ color: 'black' }}>Market'</span>
                    <span style={{ color: '#8D6E63' }}>Art</span>
                </div>

                {/* Navigation */}
                <ul style={ulStyle}>
                    {[ 
                        { name: 'Accueil', route: '/home' },
                        { name: 'Profil', route: '/profil' },
                        { name: 'Commandes', route: '/commandes' },
                        { name: 'Achats', route: '/achats' },
                    ].map((item, index) => (
                        <li key={index}>
                            <Link
                                to={item.route} // Utilisation de `to` au lieu de `href`
                                style={{
                                    ...linkStyle,
                                    ...(isActive(item.route) ? activeLinkStyle : {}),
                                }}
                                onMouseOver={(e) => e.target.style.color = linkHoverStyle}
                                onMouseOut={(e) => e.target.style.color = isActive(item.route) ? '#9C1D39' : '#4B0044'}
                            >
                                {item.name}
                            </Link>
                        </li>
                    ))}

                    {/* Déconnexion */}
                    <li>
                        <button
                            style={{
                                ...linkStyle,
                                background: 'none',
                                border: 'none',
                                cursor: 'pointer',
                                padding: 0,
                            }}
                            onMouseOver={(e) => (e.target.style.color = linkHoverStyle)}
                            onMouseOut={(e) => (e.target.style.color = linkStyle.color)}
                            onClick={handleLogout}
                        >
                            Déconnexion
                        </button>
                    </li>
                </ul>
            </nav>
        </header>
    );
};

export default Header;
