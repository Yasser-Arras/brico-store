# BricoMag - E-commerce Laravel

BricoMag est une application e-commerce développée avec Laravel.
Elle inclut un système de boutique, panier, commandes et un panel admin complet (produits, catégories, utilisateurs, commandes).

---

##  Stack technique

| Technologie | Version |
|-------------|---------|
| Laravel | 12+ |
| PHP | 8+ |
| Templates | Blade |
| CSS Framework | Tailwind CSS |
| Base de données | MySQL |
| Bundler | Vite |

---

##  Installation du projet

### 1. Cloner le projet

```bash
git clone https://github.com/ton-repo/bricomag.git
cd bricomag
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Installer les dépendances frontend

```bash
npm install
npm run dev
```

### 4. Configurer le fichier `.env`

```bash
cp .env.example .env
```

Puis configurer et modifier les variables suivantes :

```env
DB_DATABASE=bricomag
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Générer la clé Laravel

```bash
php artisan key:generate
```

### 6. Migrer la base de données

```bash
php artisan migrate
```


### 7. Migrer la base de données

```bash
php artisan db:seed
```


## Pour les images, ajouter le contenu de fichier storage_app_public_images.zip dans storage/app/public 
## Puis executer cette commande:

```bash
php artisan storage:link
```



### 9. Lancer le serveur

```bash
php artisan serve
```

---

## 👤 Système utilisateurs

### Rôles disponibles

| Rôle | Accès |
|------|-------|
| `user` | Utilisateur normal |
| `admin` | Accès panel admin |

---
Compte admin :
Email : admin@bricomag.test
Password : password
---
##  Fonctionnalités

### Boutique
- Liste des produits
- Détail produit
- Ajout au panier

### Panier
- Ajouter des produits
- Modifier les quantités
- Supprimer des produits
- Panier basé sur la session

### Commandes
- Validation du panier
- Création de commande
- Déduction automatique du stock
- Un système de paiement pourra être ajouté pour commandes réeles. 

### Authentification
- Login / Register
- Middleware auth

### Panel Admin
- CRUD Produits
- CRUD Catégories
- CRUD Utilisateurs
- Gestion des commandes
- 
---

##  Améliorations possibles

- [ ] Pagination avancée
- [ ] Filtrage des produits
- [ ] Notifications modernes
- [ ] Dashboard analytics
- [ ] Intégration d'un provideur de paiment (Ex: Stripe..)
- [ ] Intégration d'un provideur des newsletters
---

##  Notes importantes

- Le panier est stocké **en session**
- Les stocks sont **vérifiés côté serveur**
- Les commandes sont créées en **transaction DB**
- Les utilisateurs admin sont protégés par **middleware**

