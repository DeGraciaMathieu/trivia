---
ordre: 63
terme: "Ariane 501"
categorie: "Contresens"
date: "4 juin 1996 — 37 secondes"
teaser: "Le code fautif n'aurait pas dû tourner du tout. Il ne servait à rien après le décollage."
retenir: "Une redondance qui fait tourner le même code ne redonde rien."
aujourdhui: "Trois leçons intactes : du code réutilisé traîne ses hypothèses avec lui, une preuve vaut pour un contexte, et un secours identique à l'original n'est pas un secours."
---
On raconte un dépassement de capacité lors d'une conversion vers un entier sur 16 bits. C'est exact, mais c'est la dernière ligne de l'histoire. Le code en question venait d'Ariane 4 et calculait un alignement inertiel utile avant le décollage seulement ; il continuait à tourner quarante secondes après, pour permettre un redémarrage rapide en cas de report — un besoin propre à Ariane 4, inexistant sur Ariane 5.

La valeur ne pouvait pas déborder : cela avait été analysé et démontré. Sur la trajectoire d'Ariane 4. Ariane 5 accélérait plus fort, et la démonstration ne s'appliquait plus à elle.

L'exception n'étant pas traitée, la centrale s'arrête et émet un motif de diagnostic, que l'étage suivant interprète comme des données de vol. La centrale de secours, elle, exécutait le même logiciel et s'était déjà arrêtée pour la même raison une fraction de seconde plus tôt.
