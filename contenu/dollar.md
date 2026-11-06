---
ordre: 28
terme: "$variable"
categorie: "Langages & outils"
date: "1964 — BASIC, puis le shell"
teaser: "Le signe n'a pas été choisi pour ce qu'il évoque, mais parce que c'était un des quatre qui restaient."
retenir: "L'informatique a hérité du clavier de la comptabilité."
aujourdhui: "La preuve que c'était arbitraire : IBM, face au même besoin, a pris <code>&amp;</code> — les variables en JCL s'écrivent <code>&amp;NOM</code>. Et l'effet de bord le plus utile du sigil, personne ne l'avait prévu : en PHP, <code>$class</code> et <code>$for</code> sont des noms valides, puisqu'une variable ne peut jamais entrer en collision avec un mot réservé."
---
Le besoin vient des langages où le texte est la norme et le code l'exception : un script shell, puis un gabarit HTML. Il faut un signal qui dise « ici, ne recopie pas, va chercher la valeur ». Reste à choisir lequel.

L'inventaire est vite fait. Sur la trentaine de signes de ponctuation d'ASCII, presque tout est pris : l'arithmétique, la comparaison, le groupement, les bits, la négation. Il ne reste que <code>$</code>, <code>@</code>, <code>#</code> et <code>_</code>. Et deux des quatre sont des pièges : dans les variantes nationales d'ISO 646, ce sont exactement les caractères qu'on sacrifiait pour caser les accents. Sur un terminal français, <code>@</code> affichait <b>à</b> et <code>#</code> affichait <b>£</b>. Le dollar, lui, a survécu presque partout.

S'il était sur tous les claviers, c'est que les téléscripteurs descendaient des machines à écrire de bureau, conçues pour la correspondance commerciale : des factures et des prix. L'association avec les identifiants est antérieure au shell — BASIC écrit déjà <code>A$</code> en 1964, pour une raison purement graphique : le dollar ressemble à un S, comme <i>String</i>.
