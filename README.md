
# BackendPweb 🚀  
Bienvenue dans le backend le plus stylé que tu n’aies jamais vu ! Ici, nous avons de quoi habiller le monde avec style et élégance, un modèle à la fois. 🎨✨  

## 🌟 À propos  
**BackendPweb** est l’API REST qui alimente **FashionApp**, une plateforme dédiée à la mise en relation de stylistes et de clients pour des créations sur mesure. Avec des fonctionnalités robustes comme la gestion des utilisateurs, des stylistes, des commandes, des paiements et bien plus encore, **BackendPweb** est conçu pour répondre aux besoins d’une application moderne et évolutive.  

## 🛠️ Fonctionnalités clés  
- **Gestion des utilisateurs** : Clients, stylistes, et admins.  
- **Stylistes** : Profils, spécialités, disponibilité, et système de notation.  
- **Commandes** : De la création à la livraison en passant par le paiement.  
- **Favoris et promotions** : Ajoutez des modèles à vos favoris ou profitez des offres du moment.  
- **Catégories et modèles** : Naviguez parmi les créations disponibles.  

---

## 🚀 Comment démarrer  
### Prérequis  
1. **Node.js** : Version 18+  
2. **MySQL** : Version 8.0 ou plus récente.  
3. **Git** : Pour cloner le projet.  

### Étapes d’installation  
1. Clonez le dépôt :  
   ```bash
   git clone https://github.com/votre-compte-github/BackendPweb.git
   cd BackendPweb
   ```  

2. Installez les dépendances :
   ```bash
   npm install
   ```  

3. Configurez votre environnement :  
   Copiez le fichier `.env.example` en `.env` et configurez vos variables :
   ```env
   DB_HOST=localhost  
   DB_PORT=3306  
   DB_USER=root  
   DB_PASSWORD=monSuperMotDePasse  
   DB_NAME=fashion_app  
   APP_PORT=3000  
   ```  

4. Initialisez la base de données :  
   Importez le fichier SQL situé dans `sql/fashion_app.sql` dans votre instance MySQL :
   ```bash
   mysql -u root -p fashion_app < sql/fashion_app.sql
   ```  

5. Démarrez le serveur :
   ```bash
   npm run dev
   ```  
   Visitez [http://localhost:3000](http://localhost:3000) pour tester.

---

## 📂 Structure du projet
Voici un aperçu des dossiers principaux :
```plaintext
BackendPweb/  
├── models/          # Modèles de données  
├── controllers/     # Contrôleurs pour chaque ressource  
├── routes/          # Définition des endpoints  
├── middlewares/     # Middlewares pour la sécurité et la validation  
├── config/          # Fichiers de configuration  
├── sql/             # Script SQL pour la base de données  
└── tests/           # Tests unitaires et d'intégration  
```  

---

## 🚦 Points de départ pour le développement
- **Les modèles** : Créez ou mettez à jour les fichiers dans `models/` en fonction de vos besoins.
- **Les routes** : Ajoutez vos endpoints dans `routes/`.
- **La documentation** : Toutes les routes existantes sont décrites dans `docs/routes.md`.
- **Tests** : Assurez-vous que tout fonctionne avec les scripts situés dans `tests/`.

---

## 🤔 FAQ
1. **Comment ajouter une nouvelle table à la base de données ?**  
   Ajoutez votre table au fichier SQL, synchronisez la base et mettez à jour les modèles dans `models/`.

2. **Comment contribuer ?**
    - Créez une branche pour votre fonctionnalité :
      ```bash
      git checkout -b feature/ma-fonctionnalite
      ```  
    - Une fois terminé, ouvrez une pull request. 🎉

---


### Pourquoi le styliste a-t-il été nommé "Admin de l’année" ?  
### Parce qu’il sait toujours bien gérer les conflits… même en production ! 👔🔥

---

Merci de contribuer et de rendre **BackendPweb** encore plus génial ! 💻  
Auteur : **Fox** 🦊
