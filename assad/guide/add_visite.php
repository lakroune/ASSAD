<?php
session_start();

// --- Inclusion du fichier de connexion à la base de données (à décommenter)
// include "../db_connect.php"; 

// 1. Vérification stricte des variables de session pour l'accès guide
if (
    isset($_SESSION['user_role'], $_SESSION['logged_in'], $_SESSION['user_id'], $_SESSION['user_name']) &&
    $_SESSION['user_role'] === "guide" &&
    $_SESSION['logged_in'] === TRUE
) 
echo "";
?>

<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Ajouter une Visite - ASSAD</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ec7f13",
                        "background-light": "#fcfaf8",
                        "background-dark": "#221910",
                        "surface-light": "#ffffff",
                        "surface-dark": "#2d241b",
                        "text-main-light": "#1b140d",
                        "text-main-dark": "#fcfaf8",
                        "text-sec-light": "#9a734c",
                        "text-sec-dark": "#d0bba6",
                        "border-light": "#e7dbcf",
                        "border-dark": "#4a3b2f",
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
    <style>
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 1,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }

        body {
            font-family: "Plus Jakarta Sans", sans-serif;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark min-h-screen text-text-main-light dark:text-text-main-dark transition-colors duration-200">
    <div class="flex h-screen w-full overflow-hidden">
        <aside class="hidden lg:flex flex-col w-72 border-r border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark p-6 h-full justify-between">
            <div class="flex flex-col gap-8">
                <div class="flex items-center gap-3 px-2">
                    <div class="bg-primary/20 p-2 rounded-lg">
                        <span class="material-symbols-outlined text-primary text-3xl">pets</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-tight">ASSAD</h1>
                        <p class="text-text-sec-light dark:text-text-sec-dark text-xs uppercase tracking-wider font-semibold">Guide Space</p>
                    </div>
                </div>
                <nav class="flex flex-col gap-2">
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-text-main-light dark:text-text-sec-dark hover:bg-border-light dark:hover:bg-surface-dark transition-colors font-medium" href="tableau_de_bord.php">
                        <span class="material-symbols-outlined text-text-sec-light dark:text-text-sec-dark">dashboard</span>
                        <span>Tableau de bord</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary/10 text-primary dark:text-primary font-bold" href="mes_visites.php">
                        <span class="material-symbols-outlined">map</span>
                        <span>Mes Visites</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-text-main-light dark:text-text-sec-dark hover:bg-border-light dark:hover:bg-surface-dark transition-colors font-medium" href="reservations.php">
                        <span class="material-symbols-outlined text-text-sec-light dark:text-text-sec-dark">groups</span>
                        <span>Réservations</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-text-main-light dark:text-text-sec-dark hover:bg-border-light dark:hover:bg-surface-dark transition-colors font-medium" href="parametres.php">
                        <span class="material-symbols-outlined text-text-sec-light dark:text-text-sec-dark">settings</span>
                        <span>Paramètres</span>
                    </a>
                </nav>
            </div>
            <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark shadow-sm">
                <div class="bg-center bg-cover rounded-full h-10 w-10 border-2 border-primary" data-alt="Portrait du guide" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB6SweDCChTHrnzUi3ijD-HqKt7FximPeaVPRuHptoZB3gCiNIREev191XH6lCU2g9dWO-0nb19loXauXqO29KxIYeVB8L_qXV7j_z9ew9PCkxmtTGzyhArcCoyjioHHD9oWPKFoA4SKfrqRSRlWptyCfastPtNkgSlFizXCwA60Izfk-CrC13bruBTAOjH610XOUvFB1RnfkoM-IeFW7fkvzAujenUwRWp02gjgWiOhb4zpbuGErPegntLM0188b1Dkbt6DnzndgR5");'></div>
                <div class="flex flex-col overflow-hidden">
                    <p class="text-sm font-bold truncate"><?= $nom_utilisateur ?></p>
                    <p class="text-text-sec-light dark:text-text-sec-dark text-xs truncate">Guide <?= htmlspecialchars($role_utilisateur) ?></p>
                </div>
            </div>
        </aside>
        <main class="flex-1 flex flex-col h-full overflow-y-auto overflow-x-hidden">
            <div class="lg:hidden flex items-center justify-between p-4 border-b border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark sticky top-0 z-20">
                <span class="material-symbols-outlined text-primary">pets</span>
                <span class="material-symbols-outlined text-text-main-light dark:text-text-main-dark">menu</span>
            </div>

            <div class="p-6 md:p-10 max-w-5xl mx-auto w-full flex flex-col gap-8">

                <a href="mes_visites.php" class="text-sm text-text-sec-light dark:text-text-sec-dark hover:text-primary transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Retour à Mes Visites
                </a>

                <div class="flex flex-col gap-1 pb-4 border-b border-border-light dark:border-border-dark">
                    <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight">Créer une Nouvelle Visite</h2>
                    <p class="text-text-sec-light dark:text-text-sec-dark text-lg">Planifiez et publiez une nouvelle expérience virtuelle pour les visiteurs.</p>
                </div>

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

                <form method="POST" action="add_visite.php" enctype="multipart/form-data" class="flex flex-col gap-8 bg-surface-light dark:bg-surface-dark rounded-xl border border-border-light dark:border-border-dark shadow-xl p-6 md:p-8">

                    <div class="flex flex-col gap-5">
                        <h3 class="text-2xl font-bold text-primary border-b border-border-light dark:border-border-dark pb-2 flex items-center gap-2">
                            <span class="material-symbols-outlined">description</span>
                            Détails de la Visite
                        </h3>

                        <div>
                            <label for="title" class="block text-sm font-medium text-text-sec-light dark:text-text-sec-dark mb-1">Titre de la Visite <span class="text-red-500">*</span></label>
                            <input type="text" id="title" name="title" value="<?= htmlspecialchars($tour_default['title']) ?>" required
                                class="w-full px-4 py-2 border border-border-light dark:border-border-dark rounded-lg bg-background-light dark:bg-surface-dark/50 focus:border-primary focus:ring-primary text-text-main-light dark:text-text-main-dark text-lg font-semibold" placeholder="Ex: Safari Virtuel au Coucher du Soleil" />
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-text-sec-light dark:text-text-sec-dark mb-1">Description Détaillée</label>
                            <textarea id="description" name="description" rows="5"
                                class="w-full px-4 py-2 border border-border-light dark:border-border-dark rounded-lg bg-background-light dark:bg-surface-dark/50 focus:border-primary focus:ring-primary text-text-main-light dark:text-text-main-dark resize-none" placeholder="Décrivez le contenu, les espèces présentées, et ce que les visiteurs apprendront."><?= htmlspecialchars($tour_default['description']) ?></textarea>
                            <p class="text-xs text-text-sec-light dark:text-text-sec-dark mt-1">Cette description sera utilisée pour la réservation.</p>
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium text-text-sec-light dark:text-text-sec-dark mb-1">Catégorie</label>
                            <select id="category" name="category"
                                class="w-full px-4 py-2 border border-border-light dark:border-border-dark rounded-lg bg-background-light dark:bg-surface-dark/50 focus:border-primary focus:ring-primary text-text-main-light dark:text-text-main-dark">
                                <?php foreach ($categories as $cat) : ?>
                                    <option value="<?= htmlspecialchars($cat) ?>" <?= $tour_default['category'] === $cat ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cat) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>

                    <div class="flex flex-col gap-5">
                        <h3 class="text-2xl font-bold text-primary border-b border-border-light dark:border-border-dark pb-2 flex items-center gap-2">
                            <span class="material-symbols-outlined">schedule</span>
                            Planning et Logistique
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="date" class="block text-sm font-medium text-text-sec-light dark:text-text-sec-dark mb-1">Date <span class="text-red-500">*</span></label>
                                <input type="date" id="date" name="date" value="<?= htmlspecialchars($tour_default['date']) ?>" required
                                    class="w-full px-4 py-2 border border-border-light dark:border-border-dark rounded-lg bg-background-light dark:bg-surface-dark/50 focus:border-primary focus:ring-primary text-text-main-light dark:text-text-main-dark" />
                            </div>

                            <div>
                                <label for="time" class="block text-sm font-medium text-text-sec-light dark:text-text-sec-dark mb-1">Heure <span class="text-red-500">*</span></label>
                                <input type="time" id="time" name="time" value="<?= htmlspecialchars($tour_default['time']) ?>" required
                                    class="w-full px-4 py-2 border border-border-light dark:border-border-dark rounded-lg bg-background-light dark:bg-surface-dark/50 focus:border-primary focus:ring-primary text-text-main-light dark:text-text-main-dark" />
                            </div>

                            <div>
                                <label for="duration" class="block text-sm font-medium text-text-sec-light dark:text-text-sec-dark mb-1">Durée (en minutes)</label>
                                <input type="number" id="duration" name="duration" value="<?= htmlspecialchars($tour_default['duration']) ?>" min="15" max="180"
                                    class="w-full px-4 py-2 border border-border-light dark:border-border-dark rounded-lg bg-background-light dark:bg-surface-dark/50 focus:border-primary focus:ring-primary text-text-main-light dark:text-text-main-dark" />
                            </div>
                        </div>

                        <div>
                            <label for="link" class="block text-sm font-medium text-text-sec-light dark:text-text-sec-dark mb-1">Lien de la salle de Visite (Zoom, Teams, etc.) <span class="text-red-500">*</span></label>
                            <input type="url" id="link" name="link" value="<?= htmlspecialchars($tour_default['link']) ?>" required
                                class="w-full px-4 py-2 border border-border-light dark:border-border-dark rounded-lg bg-background-light dark:bg-surface-dark/50 focus:border-primary focus:ring-primary text-text-main-light dark:text-text-main-dark" placeholder="https://lien-de-votre-conference.com" />
                            <p class="text-xs text-text-sec-light dark:text-text-sec-dark mt-1">Ce lien sera envoyé aux participants après confirmation de la réservation.</p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-5">
                        <h3 class="text-2xl font-bold text-primary border-b border-border-light dark:border-border-dark pb-2 flex items-center gap-2">
                            <span class="material-symbols-outlined">settings_input_svideo</span>
                            Limites et Média
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="max_participants" class="block text-sm font-medium text-text-sec-light dark:text-text-sec-dark mb-1">Nombre maximum de participants</label>
                                <input type="number" id="max_participants" name="max_participants" value="<?= htmlspecialchars($tour_default['max_participants']) ?>" min="1" required
                                    class="w-full px-4 py-2 border border-border-light dark:border-border-dark rounded-lg bg-background-light dark:bg-surface-dark/50 focus:border-primary focus:ring-primary text-text-main-light dark:text-text-main-dark" />
                                <p class="text-xs text-text-sec-light dark:text-text-sec-dark mt-1">Nombre maximal de personnes pouvant s'inscrire à cette visite.</p>
                            </div>
                        </div>

                        <div>
                            <label for="image_upload" class="block text-sm font-medium text-text-sec-light dark:text-text-sec-dark mb-1">Image de Couverture</label>
                            <input type="file" id="image_upload" name="image_upload" accept="image/*" required
                                class="block w-full text-sm text-text-sec-light dark:text-text-sec-dark
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-primary/10 file:text-primary
                                hover:file:bg-primary/20" />
                            <p class="text-xs text-text-sec-light dark:text-text-sec-dark mt-1">L'image sera utilisée pour l'aperçu public de votre visite.</p>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 pt-6 border-t border-border-light dark:border-border-dark">
                        <a href="mes_visites.php" class="flex items-center gap-2 px-6 py-2.5 rounded-lg border border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark font-bold hover:bg-border-light dark:hover:bg-surface-dark transition-colors">
                            <span class="material-symbols-outlined text-[20px]">cancel</span>
                            <span>Annuler</span>
                        </a>
                        <button type="submit" name="create_tour" class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-lg font-bold shadow-lg shadow-green-600/30 transition-all transform hover:scale-[1.02]">
                            <span class="material-symbols-outlined text-[20px]">add_circle</span>
                            <span>Créer la Visite</span>
                        </button>
                    </div>
                </form>

            </div>
        </main>
    </div>
</body>

</html>