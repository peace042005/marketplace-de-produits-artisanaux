import React, { useState, useEffect } from 'react';
import axios from 'axios';

const Home = () => {
    const [products, setProducts] = useState([]);

    // Récupération des articles depuis l'API
    useEffect(() => {
        axios.get('http://127.0.0.1:8000/api/articles')
            .then((response) => {
                console.log("Données reçues :", response.data);
                
                // Vérifiez si les données contiennent le champ `created_at`
                const articles = response.data;
                if (articles && Array.isArray(articles)) {
                    // Trier les produits par date décroissante si `created_at` existe
                    const sortedProducts = articles.sort((a, b) => {
                        const dateA = new Date(a.created_at);
                        const dateB = new Date(b.created_at);
                        return dateB - dateA; // Plus récent en premier
                    });
                    setProducts(sortedProducts);
                } else {
                    console.error("Les données ne contiennent pas d'articles ou de champ `created_at`.");
                }
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
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
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

    // Styles simplifiés
    const productGridStyle = {
        display: 'grid',
        gridTemplateColumns: 'repeat(auto-fit, minmax(250px, 1fr))',
        gap: '1.5rem',
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

    const productPriceStyle = {
        fontWeight: 'bold',
        color: '#9C1D39',
    };

    const orderButtonStyle = {
        backgroundColor: '#FFD166',
        color: 'white',
        border: 'none',
        padding: '0.5rem 1rem',
        borderRadius: '5px',
        cursor: 'pointer',
    };

    const baseUrl = 'http://localhost:8000/storage/';

    return (
        <div>
            <h2>Nos Articles</h2>
            <section style={productGridStyle}>
                {products.map((product) => (
                    <div key={product.id} style={productCardStyle}>
                        <img
                            src={product.image ? `${baseUrl}${product.image}` : 'https://via.placeholder.com/120'}
                            alt={product.name}
                            style={productImageStyle}
                        />
                        <h2>{product.name}</h2>
                        <p>{product.description}</p>
                        <p style={productPriceStyle}>{product.price}€</p>
                        <button
                            style={orderButtonStyle}
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
