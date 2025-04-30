<?php
function hasPermission($role, $module) {
    $permissions = [
        'admin' => ['clients', 'produits', 'ventes', 'fournisseurs', 'utilisateurs'],
        'utilisateur' => ['clients', 'produits']
    ];
    return in_array($module, $permissions[$role]);
}
?>
