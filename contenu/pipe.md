---
ordre: 20
terme: "le pipe |"
categorie: "Unix"
date: "1964 (l'idée) — 1973 (le code)"
teaser: "Une note de service restée neuf ans dans un tiroir."
retenir: "La contrainte d'interface commune vaut mieux que la richesse de chaque outil."
aujourdhui: "Les pipelines CI, les streams, les middlewares HTTP : à chaque fois le même motif, formulé dans une note de 1964."
---
En 1964, Doug McIlroy écrit un mémo chez Bell Labs : il faudrait pouvoir visser les programmes les uns aux autres comme des tuyaux d'arrosage, la sortie de l'un devenant l'entrée du suivant. L'idée est notée, puis reste en plan.

McIlroy relance le sujet pendant des années. En 1973, Ken Thompson finit par l'implémenter — en une nuit, d'après son récit. Le lendemain, toute l'équipe réécrit les commandes pour qu'elles se comportent en filtres : lire l'entrée standard, écrire la sortie standard, se taire.

Ce n'est pas une fonctionnalité parmi d'autres, c'est ce qui définit la philosophie Unix : de petits outils qui font une chose, composables parce qu'ils partagent une interface unique — du texte.
