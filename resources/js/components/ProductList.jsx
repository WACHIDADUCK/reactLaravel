import React, { useState, useEffect } from 'react';
import axios from 'axios';


const Main = () => {
    const [products, setProducts] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        // Función para obtener los productos desde el endpoint
        const fetchProducts = async () => {
            try {
                const response = await axios.get('/api/products', { withCredentials: true });
                setProducts(response.data.data); // Asumiendo que los datos están en response.data.data
                setLoading(false);
                if (response.redirected) {
                    window.location.href = response.url;
                    return;
                }
            } catch (err) {
                setError(err.message);
                setLoading(false);
            }
        };

        fetchProducts();
    }, []); // El array vacío como segundo argumento asegura que esto se ejecute solo una vez

    const deleteProduct = async (productId) => {
        if (!window.confirm("¿Estás seguro de que quieres eliminar este producto?")) return;

        try {
            await axios.get("/sanctum/csrf-cookie");

            await axios.delete(`/api/products/${productId}`, { withCredentials: true });

            alert("Producto eliminado correctamente");
            setProducts(products.filter(product => product.id !== productId));
        } catch (error) {
            console.error("Error eliminando el producto:", error);
        }
    };

    console.log(products);

    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error: {error}</div>;

    return (

        <div className="card">
            <h1>Product List</h1>
            <ul>
                {products.map(product => (
                    <li key={product.id}>
                        <h2>{product.name}</h2>
                        <p>{product.description}</p>
                        <p>Price: ${product.price}</p>
                        <p>Quantity: {product.quantity}</p>
                        <p>Created by user: {product.user_id}</p>
                        <button onClick={() => deleteProduct(product.id)}>Delete</button>
                    </li>
                ))}
            </ul>
        </div>

    );
};

export default Main;
