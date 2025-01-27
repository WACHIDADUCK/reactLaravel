import React, { useState, useEffect } from 'react';
import axios from 'axios';



export default function ProductList() {
    const [products, setProducts] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    const [paginaActual, setPaginaActual] = useState();
    const [productsPage, setProductsPage] = useState();




    useEffect(() => {
        // Función para obtener los productos desde el endpoint
        const fetchProducts = async () => {
            try {
                const response = await axios.get('/api/products');
                setProducts(response.data); // Asumiendo que los datos están en response.data.data
                setLoading(false);
            } catch (err) {
                setError(err.message);
                setLoading(false);
            }
        };

        fetchProducts();
    }, []); // El array vacío como segundo argumento asegura que esto se ejecute solo una vez


    useEffect(() => {
        console.log(products);
    }, [paginaActual])

    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error: {error}</div>;

    return (

        <div>
            {
                products.meta.links.map((link, index) => (
                    <a key={index} href={link.url}>{link.label}</a>
                ))
            }
            <h1>Product List</h1>
            <ul>
                {products.data.map(product => (
                    <div>
                        <img src={product.image} />

                        <li key={product.id}>
                            <h2>{product.name}</h2>
                            <p>{product.description}</p>
                            <p>Price: ${product.price}</p>
                            <p>Quantity: {product.quantity}</p>
                        </li>
                    </div>
                ))}
            </ul>
        </div>

    );
};
