<div class="navbar">
    <a href="/gestion_entreprise/dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">Dashboard</a>
    <a href="/gestion_entreprise/module/clients/index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' && strpos($_SERVER['REQUEST_URI'], 'clients') !== false ? 'active' : ''; ?>">Clients</a>
    <a href="/gestion_entreprise/module/ventes/index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' && strpos($_SERVER['REQUEST_URI'], 'ventes') !== false ? 'active' : ''; ?>">Ventes</a>
    <a href="/gestion_entreprise/module/produits/index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' && strpos($_SERVER['REQUEST_URI'], 'produits') !== false ? 'active' : ''; ?>">Produits</a>
    <a href="/gestion_entreprise/module/fournisseurs/index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' && strpos($_SERVER['REQUEST_URI'], 'fournisseurs') !== false ? 'active' : ''; ?>">Fournisseurs</a>
    <a href="/gestion_entreprise/module/utilisateurs/index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' && strpos($_SERVER['REQUEST_URI'], 'utilisateurs') !== false ? 'active' : ''; ?>">Utilisateurs</a>

</div>


<style>
    .navbar {
        display: flex;
        justify-content: space-around;
        align-items: center;
        background-color: #007BFF;
        padding: 10px 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .navbar a {
        text-decoration: none;
        color: white;
        font-size: 16px;
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    .navbar a:hover {
        background-color: #0056b3;
    }
    .navbar a.active {
        background-color: #28a745;
    }
</style>
