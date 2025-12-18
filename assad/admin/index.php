 <?php
    session_start();
    $_SESSION['role_utilisateur'] = "admin";
    include "../db_connect.php";

    if (
        isset($_SESSION['role_utilisateur'], $_SESSION['logged_in'], $_SESSION['id_utilisateur'], $_SESSION['nom_utilisateur']) &&
        $_SESSION['role_utilisateur'] === "admin" &&
        $_SESSION['logged_in'] === TRUE
    ) {
        $id_utilisateur = htmlspecialchars($_SESSION['id_utilisateur']);
        $nom_utilisateur = htmlspecialchars($_SESSION['nom_utilisateur']);
        $role_utilisateur = htmlspecialchars($_SESSION['role_utilisateur']);

     
     
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
    <title>Tableau de Bord Admin - Gestion Complète - ASSAD</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
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
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary text-white shadow-md shadow-primary/20"
                        href="index.php">
                        <span class="material-symbols-outlined text-2xl fill-current">dashboard</span>
                        <span class="text-sm font-medium">Vue d'ensemble</span>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-text-secondary-light dark:text-text-secondary-dark hover:bg-primary/10 hover:text-primary transition-colors group"
                        href="./admin_animaux.php">
                        <span
                            class="material-symbols-outlined text-2xl group-hover:text-primary transition-colors">pets</span>
                        <span class="text-sm font-medium">Gestion Animaux</span>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-text-secondary-light dark:text-text-secondary-dark hover:bg-primary/10 hover:text-primary transition-colors group"
                        href="./admin_habitats.php">
                        <span
                            class="material-symbols-outlined text-2xl group-hover:text-primary transition-colors">nature</span>
                        <span class="text-sm font-medium">Habitats</span>
                    </a>
                  
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-text-secondary-light dark:text-text-secondary-dark hover:bg-primary/10 hover:text-primary transition-colors group"
                        href="./admin_users.php">
                        <span
                            class="material-symbols-outlined text-2xl group-hover:text-primary transition-colors">group</span>
                        <span class="text-sm font-medium">Utilisateurs</span>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-text-secondary-light dark:text-text-secondary-dark hover:bg-primary/10 hover:text-primary transition-colors group"
                        href="#">
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
                        <h1 class="text-3xl font-black tracking-tight text-text-light dark:text-text-dark">Admin</h1>
                        <p
                            class="text-text-secondary-light dark:text-text-secondary-dark text-sm font-medium flex items-center gap-1">
                            Zoo Virtuel ASSAD
                            <span class="text-primary mx-1">•</span>
                            <span
                                class="text-xs uppercase tracking-wider bg-primary/10 text-primary px-2 py-0.5 rounded-full">Administration</span>
                        </p>
                    </div>
                    
                </div>
            </div>
        </header>
        <div class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark">
            <div class="max-w-7xl mx-auto w-full px-6 py-8 flex flex-col gap-8">
                <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div
                        class="bg-surface-light dark:bg-surface-dark p-5 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col justify-between hover:border-primary/30 transition-colors group">
                        <div class="flex justify-between items-start mb-4">
                            <div
                                class="p-3 bg-primary/10 rounded-lg text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-2xl block">group</span>
                            </div>
                            <span
                                class="text-xs text-green-600 flex items-center gap-1 font-medium bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded w-fit">
                                +12%
                            </span>
                        </div>
                        <div>
                            <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm font-medium">
                                Visiteurs Inscrits</p>
                            <h3 class="text-2xl font-bold text-text-light dark:text-text-dark">1,245</h3>
                            <p class="text-xs text-gray-400 mt-1">Top: Maroc, France, Sénégal</p>
                        </div>
                    </div>
                    <div
                        class="bg-surface-light dark:bg-surface-dark p-5 rounded-xl border-l-4 border-l-primary border-y border-r border-y-gray-100 border-r-gray-100 dark:border-y-gray-800 dark:border-r-gray-800 shadow-sm flex flex-col justify-between relative overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-24 h-24 bg-primary/5 rounded-full -mr-10 -mt-10 pointer-events-none">
                        </div>
                        <div class="flex justify-between items-start mb-4 relative z-10">
                            <div class="p-3 bg-primary/10 rounded-lg text-primary">
                                <span class="material-symbols-outlined text-2xl block">pets</span>
                            </div>
                        </div>
                        <div class="relative z-10">
                            <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm font-medium">Total
                                Animaux</p>
                            <h3 class="text-2xl font-bold text-primary">48</h3>
                            <p class="text-xs text-primary/80 mt-1 font-medium">Dont 12 Lions de l'Atlas</p>
                        </div>
                    </div>
                    <div
                        class="bg-surface-light dark:bg-surface-dark p-5 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col justify-between hover:border-primary/30 transition-colors group">
                        <div class="flex justify-between items-start mb-4">
                            <div
                                class="p-3 bg-orange-100 dark:bg-orange-900/20 rounded-lg text-orange-600 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-2xl block">visibility</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm font-medium">
                                Animal Star</p>
                            <h3 class="text-lg font-bold text-text-light dark:text-text-dark truncate">Lion "Simba"</h3>
                            <p class="text-xs text-gray-400 mt-1">3,402 vues cette semaine</p>
                        </div>
                    </div>
                    <div
                        class="bg-surface-light dark:bg-surface-dark p-5 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col justify-between hover:border-blue-200 transition-colors group">
                        <div class="flex justify-between items-start mb-4">
                            <div
                                class="p-3 bg-blue-100 dark:bg-blue-900/20 rounded-lg text-blue-600 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-2xl block">tour</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm font-medium">Top
                                Visite Guidée</p>
                            <h3 class="text-lg font-bold text-text-light dark:text-text-dark truncate">Savane Africaine
                            </h3>
                            <p class="text-xs text-gray-400 mt-1">156 réservations</p>
                        </div>
                    </div>
                </section>
              
               
            </div>
            
        </div>
    </main>

</body>

</html>