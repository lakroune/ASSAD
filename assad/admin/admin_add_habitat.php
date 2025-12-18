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
    
    // 2. SIMULATION DES DONNÉES DE RÉFÉRENCE POUR LES DROPDOWNS
    
    // Types d'habitats standardisés
    $habitat_types = ['Savane', 'Jungle', 'Marais', 'Désert', 'Aquatique', 'Montagne'];
    
    // Guides pouvant être responsables
    $guides = [
        ['id' => 205, 'name' => 'Amine El Fassi'],
        ['id' => 208, 'name' => 'Yasmine Belkadi'],
        ['id' => 110, 'name' => 'Jean L.'],
    ];
    
    // 3. Gestion de la soumission du formulaire
    $success_message = '';
    $error_message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['create_habitat'])) {
            // Ici, vous ajouteriez la logique de validation et d'insertion dans la base de données
            
            // Validation minimale
            if (empty($_POST['name']) || empty($_POST['type']) || empty($_POST['description']) || empty($_POST['guide_id'])) {
                $error_message = "Veuillez remplir tous les champs obligatoires (Nom, Type, Description, Guide).";
            } else {
                 // insert_new_habitat($_POST, $_FILES);
                 
                 // Simuler l'obtention du nouvel ID
                 $new_habitat_id = 'H-999'; 
                 
                 // Si réussi, rediriger ou afficher un message de succès
                 $success_message = "Le nouvel habitat '{$_POST['name']}' ({$_POST['type']}) a été créé avec succès (ID: {$new_habitat_id}) !";
                 
                 // Optionnellement, effacer les données du formulaire ou rediriger
                 // header("Location: admin_habitat_details.php?id={$new_habitat_id}&status=created"); exit();
            }
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
    <title>Ajouter un Nouvel Habitat - ASSAD Admin</title>
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
                        href="./index.php">
                        <span class="material-symbols-outlined text-2xl group-hover:text-primary transition-colors">dashboard</span>
                        <span class="text-sm font-medium">Vue d'ensemble</span>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-text-secondary-light dark:text-text-secondary-dark hover:bg-primary/10 hover:text-primary transition-colors group"
                        href="admin_animaux.php">
                        <span
                            class="material-symbols-outlined text-2xl group-hover:text-primary transition-colors">pets</span>
                        <span class="text-sm font-medium">Gestion Animaux</span>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary text-white shadow-md shadow-primary/20"
                        href="admin_habitats.php">
                        <span
                            class="material-symbols-outlined text-2xl fill-current">nature</span>
                        <span class="text-sm font-medium">Habitats</span>
                    </a>
                  
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-text-secondary-light dark:text-text-secondary-dark hover:bg-primary/10 hover:text-primary transition-colors group"
                        href="admin_users.php">
                        <span
                            class="material-symbols-outlined text-2xl group-hover:text-primary transition-colors">group</span>
                        <span class="text-sm font-medium">Utilisateurs</span>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-text-secondary-light dark:text-text-secondary-dark hover:bg-primary/10 hover:text-primary transition-colors group"
                        href="admin_parametres.php">
                        <span
                            class="material-symbols-outlined text-2xl group-hover:text-primary transition-colors">settings</span>
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
                        <h1 class="text-3xl font-black tracking-tight text-text-light dark:text-text-dark">Ajouter un Nouvel Habitat</h1>
                        <p
                            class="text-text-secondary-light dark:text-text-secondary-dark text-sm font-medium flex items-center gap-1">
                            Définissez une nouvelle zone virtuelle pour les animaux
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                         <a href="admin_habitats.php" class="flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 text-text-light dark:text-text-dark hover:bg-gray-100 dark:hover:bg-gray-800/50 transition-colors text-sm font-bold">
                            <span class="material-symbols-outlined text-lg">arrow_back</span>
                            Retour à la Liste
                        </a>
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
                
                <form method="POST" action="admin_add_habitat.php" enctype="multipart/form-data" class="flex flex-col gap-8">
                    
                    <section class="p-6 bg-surface-light dark:bg-surface-dark rounded-xl shadow-xl border border-gray-100 dark:border-gray-800">
                        <h2 class="text-xl font-bold text-primary mb-4 pb-2 border-b border-gray-100 dark:border-gray-800 flex items-center gap-2">
                            <span class="material-symbols-outlined text-2xl">landscape</span>
                            Informations de l'Habitat
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-text-secondary-light dark:text-text-secondary-dark mb-1">Nom de l'Habitat <span class="text-red-500">*</span></label>
                                <input type="text" id="name" name="name" required
                                    class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-background-light dark:bg-surface-dark/50 focus:border-primary focus:ring-primary text-text-light dark:text-text-dark" placeholder="Ex: Savane Centrale" />
                            </div>
                            
                            <div>
                                <label for="type" class="block text-sm font-medium text-text-secondary-light dark:text-text-secondary-dark mb-1">Type d'Environnement <span class="text-red-500">*</span></label>
                                <select id="type" name="type" required
                                    class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-background-light dark:bg-surface-dark/50 focus:border-primary focus:ring-primary text-text-light dark:text-text-dark">
                                    <option value="" disabled selected>Sélectionner un type</option>
                                    <?php foreach ($habitat_types as $type) : ?>
                                        <option value="<?= htmlspecialchars($type) ?>">
                                            <?= htmlspecialchars($type) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <label for="description" class="block text-sm font-medium text-text-secondary-light dark:text-text-secondary-dark mb-1">Description et Notes Internes <span class="text-red-500">*</span></label>
                            <textarea id="description" name="description" rows="4" required
                                class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-background-light dark:bg-surface-dark/50 focus:border-primary focus:ring-primary text-text-light dark:text-text-dark resize-none" placeholder="Détails de l'aménagement, conditions environnementales virtuelles, etc."></textarea>
                        </div>
                    </section>
                    
                    <section class="p-6 bg-surface-light dark:bg-surface-dark rounded-xl shadow-xl border border-gray-100 dark:border-gray-800">
                        <h2 class="text-xl font-bold text-primary mb-4 pb-2 border-b border-gray-100 dark:border-gray-800 flex items-center gap-2">
                            <span class="material-symbols-outlined text-2xl">person_pin</span>
                            Guide et Média
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="guide_id" class="block text-sm font-medium text-text-secondary-light dark:text-text-secondary-dark mb-1">Guide Responsable <span class="text-red-500">*</span></label>
                                <select id="guide_id" name="guide_id" required
                                    class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-background-light dark:bg-surface-dark/50 focus:border-primary focus:ring-primary text-text-light dark:text-text-dark">
                                    <option value="" disabled selected>Affecter un guide</option>
                                    <?php foreach ($guides as $guide) : ?>
                                        <option value="<?= htmlspecialchars($guide['id']) ?>">
                                            <?= htmlspecialchars($guide['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="text-xs text-text-secondary-light mt-1">Le guide chargé du suivi et de l'animation de cet habitat.</p>
                            </div>
                            
                            <div>
                                <label for="image_upload" class="block text-sm font-medium text-text-secondary-light dark:text-text-secondary-dark mb-1">Image de l'Habitat (Visite virtuelle)</label>
                                <input type="file" id="image_upload" name="image_upload" accept="image/*"
                                    class="block w-full text-sm text-text-secondary-light dark:text-text-secondary-dark
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-primary/10 file:text-primary
                                    hover:file:bg-primary/20" />
                                <p class="text-xs text-text-secondary-light mt-1">Image HD représentant le décor virtuel de cet habitat.</p>
                            </div>
                        </div>
                    </section>
                    
                    <div class="flex justify-end gap-4 pt-4 border-t border-gray-100 dark:border-gray-800">
                        <a href="admin_habitats.php" class="flex items-center gap-2 px-6 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 text-text-light dark:text-text-dark font-bold hover:bg-gray-100 dark:hover:bg-gray-800/50 transition-colors">
                            <span class="material-symbols-outlined text-[20px]">cancel</span>
                            <span>Annuler</span>
                        </a>
                        <button type="submit" name="create_habitat" class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-lg font-bold shadow-lg shadow-green-600/30 transition-all transform hover:scale-[1.01]">
                            <span class="material-symbols-outlined text-[20px]">save</span>
                            <span>Créer l'Habitat</span>
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