
# Test code Delta RM

# Note

- INFO : J'ai été contraint de dockeriser l'environnement de développement car mon environnement Ubuntu 22.04 est installé avec une version PHP 8.2 et Composer v2

- Vous n'avez pas à utiliser Docker si votre environnement est PHP 7.3 et composer v1 logiquement.

- J'ai fait la partie frontend de l'exercice en 2 versions, la version classique en Symfony/Twig qui se trouve en `./back` et une autre version en React qui se trouve en `./front` mais à chaque fois que je fais une requête d'API une nouvelle session ce créer et du coup la réponse de l'API envoie tout le temps un tableau vide, malgré que je fasse une sauvegarde en session.
- La partie `./back` correspond aux réalisations à faire
- access the application : `http://localhost:8000/`

## Réalisations

- [X] créer un formulaire avec 2 inputs text qui permettent de renseigner le nom et l'age d'un utilisateur
- [X] un bouton submit permet l'envoi des informations
- [X] créer une classe service qui va enregistrer les deux valeurs envoyées par le formulaire dans un objet User.
- [X] tous les objets User ainsi créés doivent être historisés en session.
- [X] en dessous du formulaire, afficher tout l'historique des utilisateurs sous forme de liste.
- [X] le formulaire doit avoir des contraintes :
  - le nom doit au moins avoir 2 caractères et pas plus de 50 caractères
  - l'age doit être un entier positif et être compris entre 0 et 120
- [X] le code doit être valide PSR-2
- [ ] faire le test unitaire du service
- [X] créer un validateur personnalisé qui vérifie que la première lettre du nom est bien une majuscule
- [X] créer une classe service privée qui va enregistrer les deux valeurs envoyées par le formulaire dans un objet User
- [X] mettre en place ce qu'il faut pour passer le service privé défini en public de manière automatique
- [X] Utilisation des traductions

- [X] Répondre à la question : En quoi stocker beaucoup d'objets dans les sessions pose problème ?
  - Ce n'est pas une très bonne idée de stocker des données en Session, car il est difficile de rechercher une entité en particulier.
  - Utiliser les sessions consomme beaucoup de ressources en matière de mémoire du serveur.
  - À chaque sauvegarde d'un nouvel user il faut désérialiser et sérialiser.
- [X] Répondre à la question : Quelle est la différence entre un service public et privé, et que pensez-vous de
l'exercice à ce sujet ?
  - En public on peut accéder au service en utilisant $this->get(''); depuis le controller;
  - En privé on ne peut pas acceder en utilisant $this->get('') mais on peut acceder avec l'injection de service.

# Issues

## Problèmes rencrontrés avec PHP 7.2, donc obligé d'utiliser PHP 7.3

- ### Problem 1

  - Installation request for ocramius/package-versions 1.5.1 -> satisfiable by ocramius/package-versions[1.5.1].
  - ocramius/package-versions 1.5.1 requires php ^7.3.0 -> your PHP version (7.2.34) does not satisfy that requirement.

- ### Problem 2

  - ocramius/package-versions 1.5.1 requires php ^7.3.0 -> your PHP version (7.2.34) does not satisfy that requirement.
  - doctrine/orm v2.7.2 requires ocramius/package-versions ^1.2 -> satisfiable by ocramius/package-versions[1.5.1].
  - Installation request for doctrine/orm v2.7.2 -> satisfiable by doctrine/orm[v2.7.2].

## Problème rencrontrés avec Composer v2, donc obligé d'utiliser Composer v1

- ### Problem 1

  - ocramius/package-versions is locked to version 1.5.1 and an update of this package was not requested.
  - ocramius/package-versions 1.5.1 requires composer-plugin-api ^1.0.0 -> found composer-plugin-api[2.3.0] but it does not match the constraint.

- ### Problem 2

  - symfony/flex is locked to version v1.6.2 and an update of this package was not requested.
  - symfony/flex v1.6.2 requires composer-plugin-api ^1.0 -> found composer-plugin-api[2.3.0] but it does not match the constraint.

- ### Problem 3

  - ocramius/package-versions 1.5.1 requires composer-plugin-api ^1.0.0 -> found composer-plugin-api[2.3.0] but it does not match the constraint.
  - doctrine/orm v2.7.2 requires ocramius/package-versions ^1.2 -> satisfiable by ocramius/package-versions[1.5.1].
  - doctrine/orm is locked to version v2.7.2 and an update of this package was not requested.

## Autres

J'ai mis des fichiers shell pour installer docker et docker-compose si vous voulez l'executer avec Docker

- `docker-compose build`
- `docker-compose up -d`
- access normally at `http://localhost:8000/`
