import React from 'react';

const Footer = () => {
    const footerStyle = {
        backgroundColor: '#1f2937', // Gris foncé
        color: 'white',
        fontSize: '0.875rem', // Taille de texte réduite
        fontFamily: '"Montserrat", sans-serif', // Police Montserrat
        padding: '2rem', // Plus de padding autour du footer
    };

    const logoStyle = {
        fontSize: '1.8rem', // Taille du logo
        fontWeight: 'bold',
        display: 'flex',
        alignItems: 'center',
        gap: '0.2rem',
        color: '#FFD166', // Jaune moutarde
    };

    const logoBlackStyle = {
        color: 'black',
    };

    const logoAccentStyle = {
        color: '#8D6E63', // Couleur bois
    };

    const containerStyle = {
        display: 'flex',
        justifyContent: 'space-between',
        alignItems: 'flex-start',
        margin: '2rem 10rem 2rem 5rem', // Espace entre le logo et les colonnes
    };

    const columnStyle = {
        display: 'flex',
        flexDirection: 'column',
        gap: '1rem', // Augmenté pour plus d'espacement entre les éléments
        fontSize: '1rem',
        marginRight: '3rem', // Espacement entre les colonnes
    };

    const linkStyle = {
        textDecoration: 'none',
        color: 'white',
        transition: 'color 0.3s ease',
    };

    const linkHoverStyle = {
        color: '#FFD166', // Jaune moutarde
    };

    const copyrightStyle = {
        textAlign: 'center',
        fontSize: '0.875rem',
        marginTop: '2rem',
        marginBottom: '0',
    };

    return (
        <footer style={footerStyle}>
            {/* Première ligne: Logo */}
            <div style={{ marginBottom: '1rem' }}>
                <div style={logoStyle}>
                    <span style={logoBlackStyle}>Market'</span>
                    <span style={logoAccentStyle}>Art</span>
                </div>
            </div>

            {/* Deuxième ligne: Colonnes */}
            <div style={containerStyle}>
                {/* Liens utiles */}
                <div style={columnStyle}>
                    <a href="/home" style={linkStyle} onMouseOver={(e) => e.target.style.color = linkHoverStyle.color} onMouseOut={(e) => e.target.style.color = 'white'}>Accueil</a>
                    <a href="/profil" style={linkStyle} onMouseOver={(e) => e.target.style.color = linkHoverStyle.color} onMouseOut={(e) => e.target.style.color = 'white'}>Profil</a>
                    <a href="/commandes" style={linkStyle} onMouseOver={(e) => e.target.style.color = linkHoverStyle.color} onMouseOut={(e) => e.target.style.color = 'white'}>Commandes</a>
                    <a href="/achats" style={linkStyle} onMouseOver={(e) => e.target.style.color = linkHoverStyle.color} onMouseOut={(e) => e.target.style.color = 'white'}>Achats</a>
                </div>

                {/* Contact & Citation */}
                <div style={columnStyle}>
                    <p>Contactez-nous : contact@marketart.com</p>
                    <p style={{ fontStyle: 'italic' }}>“L'art ne vit que dans l'échange.”</p>
                </div>
            </div>

            {/* Troisième ligne: Copyright */}
            <div style={copyrightStyle}>
                <p>&copy; 2024 Marketplace. Tous droits réservés.</p>
            </div>
        </footer>
    );
};

export default Footer;
