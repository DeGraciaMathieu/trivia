---
ordre: 64
terme: "Knight Capital"
categorie: "Contresens"
date: "1<sup>er</sup> août 2012 — 45 minutes"
teaser: "Ce n'est pas un bug. C'est un déploiement manuel sur sept serveurs au lieu de huit."
retenir: "Le code fautif avait sept ans. Ce qui a échoué, c'est le processus de mise en production."
aujourdhui: "Chaque étape a un équivalent moderne : supprimer le code mort plutôt que le désactiver, ne jamais réutiliser un drapeau retiré, automatiser le déploiement, router les alertes vers quelqu'un, et savoir couper avant de savoir réparer."
---
Le nouveau code réutilise un drapeau qui activait autrefois une fonction retirée en 2003, jamais supprimée du dépôt. Le déploiement est fait à la main ; un technicien oublie un des huit serveurs, et aucune relecture par un second opérateur n'est prévue. Sur ce serveur, le drapeau réveille le code mort.

Le système avait prévenu : quatre-vingt-dix-sept messages d'alerte automatiques sont partis avant l'ouverture des marchés, mentionnant la fonction fantôme. Personne n'était chargé de les lire.

Et le geste de panique a aggravé les choses. En remettant l'ancienne version sur les serveurs corrects pour « revenir en arrière », l'équipe a propagé le code mort aux huit machines. Quarante-cinq minutes, environ 440 millions de dollars, et la fin de l'entreprise.
