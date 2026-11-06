---
ordre: 39
terme: "tar"
categorie: "Unix"
date: "1979 — Unix V7"
teaser: "<i>Tape archive</i>. Tous ses défauts sont des qualités pour une bande magnétique."
retenir: "Les options bizarres d'un outil décrivent le matériel pour lequel il a été écrit."
aujourdhui: "On empaquette encore des conteneurs et des dépendances avec un format pensé pour une bobine qu'on ne peut lire que dans un sens."
---
tar est conçu pour écrire sur une bande. D'où le format : un flux linéaire, où chaque fichier est précédé d'un en-tête et suivi du fichier suivant. Pas d'index global, parce qu'on ne peut pas revenir en arrière sur une bande.

D'où aussi l'absence de compression : c'était le lecteur de bande qui s'en chargeait, en matériel. La compression est restée à l'extérieur — d'où <code>.tar.gz</code>, deux outils empilés plutôt qu'un seul format.

Et l'option <code>-f</code> pour préciser le fichier existe parce que la destination par défaut, c'était le lecteur de bande. Le disque était le cas particulier qu'il fallait signaler.
