import { createInertiaApp } from '@inertiajs/inertia-react';
import React from 'react';
import ReactDOM from 'react-dom/client';
import Header from './components/Header';
import Footer from './components/Footer';

createInertiaApp({
    resolve: (name) => import(`./Pages/${name}.jsx`),
    setup({ el, App, props }) {
        const root = ReactDOM.createRoot(el);

        const Layout = ({ children }) => {
            const layoutStyle = {
                display: 'flex',
                flexDirection: 'column',
                minHeight: '100vh',
            };

            const mainStyle = {
                flex: '1',
                padding: '1rem',
            };

            const globalStyle = {
                margin: '0',
                padding: '0',
                boxSizing: 'border-box', // Assure une bonne gestion des bordures et padding
            };

            return (
                <>
                    {/* Style global */}
                    <style>
                        {`
                            html, body {
                                margin: 0;
                                padding: 0;
                                box-sizing: border-box;
                            }
                            *, *::before, *::after {
                                box-sizing: inherit;
                            }
                        `}
                    </style>

                    {/* Layout */}
                    <div style={layoutStyle}>
                        <Header />
                        <main style={mainStyle}>{children}</main>
                        <Footer />
                    </div>
                </>
            );
        };

        root.render(
            <Layout>
                <App {...props} />
            </Layout>
        );
    },
});
