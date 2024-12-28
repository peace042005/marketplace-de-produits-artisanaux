import React, { useState, useEffect } from 'react';
import axios from 'axios';

const Home = () => {
    const [products, setProducts] = useState([]);

    // Récupération des articles depuis l'API
    useEffect(() => {
        axios.get('/api/articles')
            .then((response) => {
                setProducts(response.data);
            })
            .catch((error) => {
                console.error("Erreur lors de la récupération des articles :", error);
            });
    }, []);

    // Fonction pour commander un article
    const handleOrder = (product) => {
        const data = {
            total: parseFloat(product.price), // Prix de l'article
        };

        axios.post('/commandes', data, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, // Ajout du token CSRF pour les requêtes sécurisées
            },
        })
        .then(() => {
            alert("Commande passée avec succès !");
        })
        .catch((error) => {
            console.error("Erreur lors de la commande :", error);
            alert("Une erreur est survenue lors de la commande.");
        });
    };

    // Styles pour la page d'accueil et les produits
    const homeStyle = {
        fontFamily: '"Montserrat", sans-serif',
        padding: '0',
        backgroundColor: '#f8f8f8',
    };

    const carouselStyle = {
        display: 'flex',
        width: '100%',
        height: '50vh', // Ajusté pour un design responsive
        overflow: 'hidden',
    };

    const carouselItemStyle = {
        minWidth: '100%',
        height: '100%',
        backgroundSize: 'cover',
        backgroundPosition: 'center',
        display: 'flex',
        justifyContent: 'center',
        alignItems: 'center',
        color: 'white',
        fontSize: '2rem',
        fontWeight: '600',
        textAlign: 'center',
    };

    const sectionTitleStyle = {
        textAlign: 'center',
        fontSize: '2rem',
        marginTop: '2rem',
        marginBottom: '2rem',
        color: '#4B0044', // Couleur violet pour l'harmonie
    };

    const productGridStyle = {
        display: 'grid',
        gridTemplateColumns: 'repeat(4, 1fr)',
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

    const productImageStyle = {
        width: '100%',
        height: '150px',
        objectFit: 'cover',
        borderRadius: '8px',
    };

    const productTitleStyle = {
        fontSize: '1.2rem',
        fontWeight: '600',
        color: '#4B0044',
        marginTop: '1rem',
    };

    const productDescriptionStyle = {
        fontSize: '0.9rem',
        color: '#666',
        margin: '0.5rem 0',
    };

    const productPriceStyle = {
        fontSize: '1.2rem',
        fontWeight: '700',
        color: '#9C1D39',
        marginTop: '0.5rem',
    };

    const orderButtonStyle = {
        backgroundColor: '#FFD166',
        color: 'white',
        border: 'none',
        padding: '0.5rem 1rem',
        borderRadius: '5px',
        cursor: 'pointer',
        marginTop: '1rem',
        transition: 'background-color 0.3s',
    };

    const orderButtonHoverStyle = {
        backgroundColor: '#9C1D39',
    };

    return (
        <div style={homeStyle}>
            {/* Section Carrousel */}
            <section style={carouselStyle}>
                <div style={{ ...carouselItemStyle, backgroundImage: 'url("https://th.bing.com/th/id/OIP.XJ5B0eNvm0-xPhV4fqpewQHaFP?rs=1&pid=ImgDetMain")' }}>
                    <div>Market'Art </div>
                    <div>Découvrez les produits des artisans locaux</div>
                </div>
                <div style={{ ...carouselItemStyle, backgroundImage: 'url("https://th.bing.com/th/id/OIP.QsPcxiNGl5gR-_sve8SFDwHaDt?rs=1&pid=ImgDetMain")' }}>
                    <div>Market'Art</div>
                    <div>Un univers d'artisanat unique</div>
                </div>
                <div style={{ ...carouselItemStyle, backgroundImage: 'url("https://th.bing.com/th/id/R.c3ce173778fa1c10f6a61532bfecc3e1?rik=l%2f%2bBfvtkZJM4Qg&riu=http%3a%2f%2fwww.hermitagebespoke.com%2fgraphics%2fobjectsart%2fart-07.jpg&ehk=oy%2bkt8HhUTg7r54t5TRyU9OomGxog3sDTWUtqZgVwd8%3d&risl=&pid=ImgRaw&r=0")' }}>
                    <div>Market'Art</div>
                    <div>Un savoir-faire local à votre portée</div>
                </div>
            </section>

            {/* Section Articles */}
            <h2 style={sectionTitleStyle}>Nos Articles</h2>
            <section style={productGridStyle}>
                {products.map((product) => (
                    <div key={product.id} style={productCardStyle}>
                        <img src={product.image} alt={product.name} style={productImageStyle} />
                        <h2 style={productTitleStyle}>{product.name}</h2>
                        <p style={productDescriptionStyle}>{product.description}</p>
                        <p style={productPriceStyle}>{product.price}€</p>
                        <button
                            style={orderButtonStyle}
                            onMouseOver={(e) => e.target.style.backgroundColor = addToCartButtonHoverStyle.backgroundColor}
                            onMouseOut={(e) => e.target.style.backgroundColor = addToCartButtonStyle.backgroundColor}
                            onClick={() => handleOrder(product)}
                        >
                            Commander
                        </button>
                    </div>
                ))}
            </section>
        </div>
    );
};

export default Home;
