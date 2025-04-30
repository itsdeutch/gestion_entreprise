// Script pour les fonctionnalités dynamiques

// Effet d'animation au survol des cartes produits
document.addEventListener('DOMContentLoaded', () => {
    const produits = document.querySelectorAll('.produit');
    produits.forEach(produit => {
        produit.addEventListener('mouseenter', () => {
            produit.style.transform = 'scale(1.05)';
            produit.style.transition = 'transform 0.3s ease';
        });
        produit.addEventListener('mouseleave', () => {
            produit.style.transform = 'scale(1)';
        });
    });
});

// Validation du formulaire d'ajout de produit
const formAjoutProduit = document.querySelector('form');
if (formAjoutProduit) {
    formAjoutProduit.addEventListener('submit', (event) => {
        const nom = document.querySelector('input[name="nom"]');
        const prix = document.querySelector('input[name="prix"]');
        if (!nom.value || !prix.value || prix.value <= 0) {
            event.preventDefault();
            alert('Veuillez remplir tous les champs correctement et vérifier le prix.');
        }
    });
}

// Menu de navigation actif
const menuItems = document.querySelectorAll('nav ul li a');
menuItems.forEach(item => {
    if (item.href === window.location.href) {
        item.classList.add('active');
    }
});

// Effet sur les liens actifs du menu
const style = document.createElement('style');
style.textContent = `
    nav ul li a.active {
        background-color: #0056b3;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }
`;
document.head.appendChild(style);
