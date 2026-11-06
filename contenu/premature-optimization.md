---
ordre: 61
terme: "« premature optimization »"
categorie: "Contresens"
date: "1974 — Donald Knuth"
teaser: "La citation est amputée juste avant la phrase qui en inverse le sens."
retenir: "Knuth ne dit pas de ne pas optimiser. Il dit de savoir où."
aujourdhui: "La citation tronquée sert surtout à clore une discussion. L'originale demande l'inverse : ouvrir un profileur."
---
Ce qu'on cite : l'optimisation prématurée est la racine de tous les maux. Ce que Knuth écrit réellement autour : que les programmeurs perdent un temps fou à se soucier de la vitesse de portions non critiques, et que cela vaut pour environ 97 % des cas.

Vient ensuite la phrase qu'on ne cite jamais : il ne faut pas pour autant laisser passer les occasions dans les 3 % critiques. Le paragraphe entier plaide pour la mesure — identifier les 3 %, puis les traiter sérieusement. Ce n'est pas un permis d'ignorer la performance, c'est une consigne de profilage.

Détail savoureux : cette phrase est tirée d'un article où Knuth défend l'usage du <code>goto</code> dans certains cas précis — donc d'un texte qui répond, six ans après, à la lettre de Dijkstra.
