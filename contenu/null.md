---
ordre: 31
terme: "null"
categorie: "Langages & outils"
date: "1965 — ALGOL W"
teaser: "Son auteur a fait des excuses publiques. Il a chiffré les dégâts à un milliard de dollars."
retenir: "Le coût d'une décision de langage se paie en décennies."
aujourdhui: "Tout l'outillage moderne consiste à réparer ça : les types Option, les analyseurs statiques, le <code>?-&gt;</code> de PHP, les types nullables explicites. On rend au type l'information qu'on lui avait retirée."
---
Tony Hoare conçoit le système de types d'ALGOL W avec l'ambition qu'aucun accès à un objet ne puisse échouer. Puis il ajoute la référence nulle — de son propre aveu, simplement parce que c'était facile à implémenter.

La conséquence est qu'une valeur de n'importe quel type peut en réalité être « rien », sans que le type le dise. Le compilateur ne peut plus rien garantir, et la vérification retombe sur le programmeur, à chaque accès, pour toujours.

En 2009, lors d'une conférence, il présente ça comme son <b>erreur à un milliard de dollars</b> : cinquante ans de plantages, de failles et de correctifs, pour une facilité d'écriture de compilateur.
