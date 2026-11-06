---
ordre: 9
terme: "cron"
categorie: "Unix"
date: "1975 — Unix V7"
teaser: "Le dieu grec du temps, réduit à cinq astérisques incompréhensibles."
retenir: "Un format optimisé pour l'écriture se paie en lecture, éternellement."
aujourdhui: "Kubernetes, GitHub Actions, Laravel : tous ont gardé la syntaxe cron à l'identique. Y compris ses ambiguïtés."
---
Le nom vient de <i>chronos</i>, le temps en grec — comme chronomètre ou chronologie. Le daemon se réveille chaque minute, regarde sa table, et lance ce qui doit l'être.

La syntaxe <code>* * * * *</code> date de la même époque : cinq champs (minute, heure, jour du mois, mois, jour de la semaine), conçus pour tenir sur une ligne de terminal étroite. La concision primait sur la lisibilité.

Résultat : cinquante ans plus tard, une profession entière ouvre un site web pour vérifier ce que fait <code>0 2 */3 * 1</code>.
