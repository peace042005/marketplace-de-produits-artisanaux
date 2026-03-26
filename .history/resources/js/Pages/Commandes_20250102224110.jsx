import React from "react";
import { Link } from "@inertiajs/react";

const Commandes = ({ commandes }) => {
    return (
        <div style={{ fontFamily: '"Montserrat", sans-serif', padding: '2rem' }}>
            <h1 style={{ textAlign: "center", color: "#4B0044" }}>Mes Commandes</h1>

            {commandes.length === 0 ? (
                <div style={{ textAlign: "center", marginTop: "2rem" }}>
                    <p style={{ fontSize: "1.2rem", color: "#666" }}>
                        Vous n'avez passé aucune commande.
                    </p>
                    <Link href="/home" style={buttonStyle}>
                        Achetez un produit
                    </Link>
                </div>
            ) : (
                <div style={gridStyle}>
                    {commandes.map((commande) => (
                        <div key={commande.id} style={cardStyle}>
                            <h2 style={titleStyle}>
                                Commande #{commande.id}
                            </h2>
                            <p style={infoStyle}>
                               <strong>Date :</strong> {new Date(commande.date_commande).toLocaleDateString('fr-FR')}
                            </p>
                            <p style={infoStyle}>
                                <strong>Total :</strong> {commande.total.toFixed(2)} FCFA
                            </p>
                            <p style={infoStyle}>
                                <strong>Statut :</strong> {commande.statut ? "Payée" : "En attente"}
                            </p>
                        </div>
                    ))}
                </div>
            )}
        </div>
    );
};

// Styles
const buttonStyle = {
    display: "inline-block",
    backgroundColor: "#FFD166",
    color: "#fff",
    padding: "0.8rem 1.5rem",
    borderRadius: "5px",
    textDecoration: "none",
    marginTop: "1rem",
    fontSize: "1rem",
    fontWeight: "600",
    cursor: "pointer",
};

const gridStyle = {
    display: "grid",
    gridTemplateColumns: "repeat(auto-fill, minmax(300px, 1fr))",
    gap: "1.5rem",
    marginTop: "2rem",
};

const cardStyle = {
    backgroundColor: "#fff",
    padding: "1.5rem",
    borderRadius: "8px",
    boxShadow: "0 2px 5px rgba(0, 0, 0, 0.1)",
    textAlign: "left",
};

const titleStyle = {
    fontSize: "1.5rem",
    fontWeight: "700",
    marginBottom: "1rem",
    color: "#4B0044",
};

const infoStyle = {
    fontSize: "1rem",
    marginBottom: "0.5rem",
    color: "#666",
};

export default Commandes;
