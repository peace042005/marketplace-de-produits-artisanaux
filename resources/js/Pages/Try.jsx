import React, { useState } from 'react';

const Home = () => {
    const [open, setOpen] = useState(false);

    return (
        <div>
            <h1>Bienvenue dans mon application avec React et Inertia.js</h1>
            <button onClick={() => setOpen(!open)}>
                {open ? 'Fermer' : 'Ouvrir'}
            </button>
            {open && <p>Vous avez ouvert le menu !</p>}
        </div>
    );
};

export default Home;
