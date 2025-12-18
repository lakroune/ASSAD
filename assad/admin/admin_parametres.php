<?php
session_start();

// --- Inclusion du fichier de connexion à la base de données (à décommenter)
// include "../db_connect.php"; 

// 1. Vérification stricte des variables de session pour l'accès Admin
if (
    isset($_SESSION['user_role'], $_SESSION['logged_in'], $_SESSION['user_id'], $_SESSION['user_name']) &&
    $_SESSION['user_role'] === "admin" &&
    $_SESSION['logged_in'] === TRUE
) {
    // Extraction des données de session
    $id_utilisateur = htmlspecialchars($_SESSION['user_id']);
    $nom_utilisateur = htmlspecialchars($_SESSION['user_name']);
    $role_utilisateur = htmlspecialchars($_SESSION['user_role']);
    
    // 2. SIMULATION DES DONNÉES DE CONFIGURATION GLOBALE
    $config = [
        'site_name' => 'ASSAD Zoo Virtuel',
        'site_url' => 'https://assad-zoo-virtuel.com',
        'default_language' => 'fr',
        'max_participants_default' => 50,
        'maintenance_mode' => false,
        'contact_email' => 'contact@assad-zoo-virtuel.com',
        'categories_list' => 'Faune Africaine, Vie Nocturne, Plantes et Flore, Oiseaux et Migration, Visite Spéciale',
    ];
    
    // 3. Gestion de la soumission du formulaire
    $success_message = '';
    $error_message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['save_settings'])) {
            // Validation et mise à jour simulée des données
            
            // Exemple simple de mise à jour
            $config['site_name'] = htmlspecialchars($_POST['site_name']);
            $config['contact_email'] = htmlspecialchars($_POST['contact_email']);
            $config['maintenance_mode'] = isset($_POST['maintenance_mode']);
            $config['categories_list'] = htmlspecialchars($_POST['categories_list']);
            
            // Ici, vous inséreriez l'appel à la base de données pour UPDATE
            
            $success_message = "Les paramètres globaux ont été sauvegardés avec succès !";
        }
    }

} else {
    // Redirection de sécurité
    header("Location: connexion.php?error=access_denied");
    exit(); 
}
?>

<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Paramètres Globaux - ASSAD Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ec7f13",
                        "primary-dark": "#d16a0a",
                        "background-light": "#f8f7f6",
                        "background-dark": "#221910",
                        "surface-light": "#ffffff",
                        "surface-dark": "#2d241b",
                        "text-light": "#1b140d",
                        "text-dark": "#f0e6dd",
                        "text-secondary-light": "#9a734c",
                        "text-secondary-dark": "#b08d6b",
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark font-display antialiased min-h-screen flex overflow-hidden">
    <aside
        class="w-64 bg-surface-light dark:bg-surface-dark border-r border-gray-200 dark:border-gray-800 flex-col hidden md:flex h-screen sticky top-0 shrink-0">
        <div class="h-full flex flex-col justify-between p-4">
            <div class="flex flex-col gap-6">
                <div class="flex items-center gap-3 px-2">
                    <div class="bg-center bg-no-repeat bg-cover rounded-full h-10 w-10 shadow-sm border border-primary/20"
                        data-alt="Abstract logo representing a lion head in orange tones"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBLtzdITINYnoOVjCU_bzpU_9pRXby0heIBLEdVS8X21OrFNaKbkKt2QBzQT6g2TlgCLazrJMWR_qW34Zv6Tj7_7PjVBI6tVF7vpjpMqb3ILmEytcvS6tyde7BUh1040h1liUA00KJKxQNaIwONa2LqVBJOPB5zlfXQptiNh4jSMeomQTLUtiPoYhXr6RVNv8W6_zOXk9IIvkFT1OeYYZ7XHdx3p9BoVqOb5Ua6dpsaIgcEH3eNYsuOi7xYESV5EqCMwKZrZoa522Uy");'>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-text-light dark:text-text-dark text-lg font-bold leading-tight">ASSAD Admin</h1>
                        <p class="text-primary text-xs font-semibold tracking-wider uppercase">Zoo Virtuel</p>
                    </div>
                </div>
                <nav class="flex flex-col gap-1">
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-text-secondary-light dark:text-text-secondary-dark hover:bg-primary/10 hover:text-primary transition-colors group"
                        href="index.php">
                        <span class="material-symbols-outlined text-2xl group-hover:text-primary transition-colors">dashboard</span>
                        <span class="text-sm font-medium">Vue d'ensemble</span>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-text-secondary-light dark:text-text-secondary-dark hover:bg-primary/10 hover:text-primary transition-colors group"
                        href="admin_animaux.php">
                        <span
                            class="material-symbols-outlined text-2xl group-hover:text-primary transition-colors">pets</span>
                        <span class="text-sm font-medium">Gestion Animaux</span>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-text-secondary-light dark:text-text-secondary-dark hover:bg-primary/10 hover:text-primary transition-colors group"
                        href="admin_habitats.php">
                        <span
                            class="material-symbols-outlined text-2xl group-hover:text-primary transition-colors">nature</span>
                        <span class="text-sm font-medium">Habitats</span>
                    </a>
                  
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-text-secondary-light dark:text-text-secondary-dark hover:bg-primary/10 hover:text-primary transition-colors group"
                        href="admin_users.php">
                        <span
                            class="material-symbols-outlined text-2xl group-hover:text-primary transition-colors">group</span>
                        <span class="text-sm font-medium">Utilisateurs</span>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary text-white shadow-md shadow-primary/20"
                        href="admin_parametres.php">
                        <span
                            class="material-symbols-outlined text-2xl fill-current">settings</span>
                        <span class="text-sm font-medium">Paramètres</span>
                    </a>
                </nav>
            </div>
            <div class="border-t border-gray-200 dark:border-gray-800 pt-4 px-2">
                <div class="flex items-center gap-3">
                    <div
                        class="bg-gray-200 h-9 w-9 rounded-full flex items-center justify-center text-gray-500 font-bold text-xs overflow-hidden">
                        <img alt="Admin profile" class="h-full w-full object-cover"
                            data-alt="Portrait of a smiling man with glasses"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDLpsL4U45kNe2pJTEnRso6tfRPA6aLzfj3_19OQE6427LVmJ5aiOc1ZRWmvboLsjGaNmK64pZi1jhhiR-v87OvRhal9yHiSxQvTiX-eipY5OBy7UKmVoRy-c_ZXvLyH0-CLxF8G1ng-sBh2jhO4Yf-eaj5B3UE6mv0ggcUeAMOn8OYOLPj8EBGQKb-92AiJo5VHKJHGnSSRxJMnzp3emTjiTzC3qYd_2iEed3MQVluydYS0yi194Z_ztMxCH_6roaeCDAm0hQHwnIW" />
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm font-medium text-text-light dark:text-text-dark"><?= $nom_utilisateur ?></p>
                        <p class="text-xs text-text-secondary-light dark:text-text-secondary-dark">Super Admin</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        <header
            class="bg-surface-light dark:bg-surface-dark border-b border-gray-200 dark:border-gray-800 shrink-0 z-10">
            <div class="px-6 py-5 max-w-7xl mx-auto w-full">
                <div class="flex flex-wrap justify-between items-end gap-4">
                    <div class="flex flex-col gap-1">
                        <h1 class="text-3xl font-black tracking-tight text-text-light dark:text-text-dark">Paramètres du Système</h1>
                        <p
                            class="text-text-secondary-light dark:text-text-secondary-dark text-sm font-medium flex items-center gap-1">
                            Gérez la configuration globale de l'application
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                         </div>
                </div>
            </div>
        </header>
        <div class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark">
            <div class="max-w-4xl mx-auto w-full px-6 py-8 flex flex-col gap-8">
                
                <?php if ($success_message): ?>
                    <div class="p-4 bg-green-100 dark:bg-green-900/40 border border-green-300 dark:border-green-700/50 text-green-700 dark:text-green-300 rounded-lg flex items-start gap-3" role="alert">
                        <span class="material-symbols-outlined text-green-700 dark:text-green-300">check_circle</span>
                        <p class="text-sm font-medium"><?= $success_message ?></p>
                    </div>
                <?php endif; ?>
                <?php if ($error_message): ?>
                    <div class="p-4 bg-red-100 dark:bg-red-900/40 border border-red-300 dark:border-red-700/50 text-red-700 dark:text-red-300 rounded-lg flex items-start gap-3" role="alert">
                        <span class="material-symbols-outlined text-red-700 dark:text-red-300">error</span>
                        <p class="text-sm font-medium"><?= $error_message ?></p>
                    </div>
                <?php endif; ?>

                <form method="POST" action="admin_parametres.php" class="flex flex-col gap-8">
                    
                    <section class="p-6 bg-surface-light dark:bg-surface-dark rounded-xl shadow-xl border border-gray-100 dark:border-gray-800">
                        <h2 class="text-xl font-bold text-primary mb-4 pb-2 border-b border-gray-100 dark:border-gray-800 flex items-center gap-2">
                            <span class="material-symbols-outlined text-2xl">public</span>
                            Informations Générales
                        </h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="site_name" class="block text-sm font-medium text-text-secondary-light dark:text-text-secondary-dark mb-1">Nom de l'Application</label>
                                <input type="text" id="site_name" name="site_name" value="<?= htmlspecialchars($config['site_name']) ?>" required
                                    class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-background-light dark:bg-surface-dark/50 focus:border-primary focus:ring-primary text-text-light dark:text-text-dark" />
                            </div>
                            
                            <div>
                                <label for="contact_email" class="block text-sm font-medium text-text-secondary-light dark:text-text-secondary-dark mb-1">Email de Contact (Support)</label>
                                <input type="email" id="contact_email" name="contact_email" value="<?= htmlspecialchars($config['contact_email']) ?>" required
                                    class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-background-light dark:bg-surface-dark/50 focus:border-primary focus:ring-primary text-text-light dark:text-text-dark" />
                            </div>
                            
                            <div>
                                <label for="site_url" class="block text-sm font-medium text-text-secondary-light dark:text-text-secondary-dark mb-1">URL Principale</label>
                                <input type="url" id="site_url" value="<?= htmlspecialchars($config['site_url']) ?>" readonly
                                    class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800/50 text-text-secondary-light dark:text-text-secondary-dark cursor-not-allowed" />
                                <p class="text-xs text-text-secondary-light mt-1">L'URL du site ne peut être modifiée que via les fichiers de configuration serveur.</p>
                            </div>
                        </div>
                    </section>

                    <section class="p-6 bg-surface-light dark:bg-surface-dark rounded-xl shadow-xl border border-gray-100 dark:border-gray-800">
                        <h2 class="text-xl font-bold text-primary mb-4 pb-2 border-b border-gray-100 dark:border-gray-800 flex items-center gap-2">
                            <span class="material-symbols-outlined text-2xl">map</span>
                            Visites et Contenu
                        </h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="categories_list" class="block text-sm font-medium text-text-secondary-light dark:text-text-secondary-dark mb-1">Liste des Catégories de Visites</label>
                                <textarea id="categories_list" name="categories_list" rows="3"
                                    class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-background-light dark:bg-surface-dark/50 focus:border-primary focus:ring-primary text-text-light dark:text-text-dark resize-none"><?= htmlspecialchars($config['categories_list']) ?></textarea>
                                <p class="text-xs text-text-secondary-light mt-1">Séparez chaque catégorie par une virgule. Ceci affecte les formulaires de création de visite.</p>
                            </div>
                             <div>
                                <label for="max_participants_default" class="block text-sm font-medium text-text-secondary-light dark:text-text-secondary-dark mb-1">Max Participants par Défaut (info)</label>
                                <input type="number" id="max_participants_default" value="<?= htmlspecialchars($config['max_participants_default']) ?>" readonly
                                    class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800/50 text-text-secondary-light dark:text-text-secondary-dark cursor-not-allowed" />
                            </div>
                        </div>
                    </section>
                    
                    <section class="p-6 bg-surface-light dark:bg-surface-dark rounded-xl shadow-xl border border-gray-100 dark:border-gray-800">
                        <h2 class="text-xl font-bold text-primary mb-4 pb-2 border-b border-gray-100 dark:border-gray-800 flex items-center gap-2">
                            <span class="material-symbols-outlined text-2xl">gpp_maybe</span>
                            Sécurité et Maintenance
                        </h2>
                        
                        <div class="flex items-start justify-between p-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-background-light dark:bg-background-dark/50">
                            <div>
                                <label for="maintenance_mode" class="text-sm font-bold text-text-light dark:text-text-dark">Activer le Mode Maintenance</label>
                                <p class="text-xs text-text-secondary-light mt-1">Le site sera inaccessible aux visiteurs non-administrateurs.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="maintenance_mode" name="maintenance_mode" value="1" <?= $config['maintenance_mode'] ? 'checked' : '' ?> class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 dark:peer-focus:ring-primary/40 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                            </label>
                        </div>
                    </section>
                    
                    <div class="flex justify-end pt-4">
                        <button type="submit" name="save_settings" class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-lg font-bold shadow-lg shadow-primary/30 transition-all transform hover:scale-[1.01]">
                            <span class="material-symbols-outlined text-[20px]">save</span>
                            <span>Enregistrer les Paramètres</span>
                        </button>
                    </div>
                </form>
                
            </div>
            <div class="pb-6 text-center">
                <p class="text-[10px] text-gray-300 uppercase tracking-[0.2em] font-bold">Inspiré par la force des Lions
                    de l'Atlas</p>
            </div>
        </div>
    </main>

</body>

</html>