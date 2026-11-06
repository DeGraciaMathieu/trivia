---
ordre: 27
terme: "!"
categorie: "Langages & outils"
date: "1969 — le langage B"
teaser: "La négation s'écrit ainsi parce qu'il n'y avait pas de touche « ¬ » sur le clavier."
retenir: "Deux négations différentes, donc deux symboles : l'un pour les bits, l'autre pour le booléen."
aujourdhui: "La preuve que rien n'était inévitable : tout ce qui ne descend pas de C a choisi le mot — <code>not</code> en Pascal, Python, Haskell, <code>.NOT.</code> en Fortran, <code>~</code> en APL. Conséquence directe : la négation est le caractère le plus facile à rater en relecture."
---
La logique n'a jamais eu un symbole unique pour la négation : <code>¬</code> chez Peano et Heyting, <code>~</code> dans les <i>Principia Mathematica</i>, une barre au-dessus de la variable en algèbre de Boole. Les premiers langages piochent dedans — ALGOL 60 et PL/I écrivent <code>¬</code>.

Mais ASCII, en 1963, ne retient pas ce caractère. Il existe chez IBM, en EBCDIC, pas sur un téléscripteur. Tout langage écrit pour ces machines doit se rabattre sur les 95 caractères disponibles, ponctuation comprise.

Dans BCPL, l'ancêtre de C, le point d'exclamation était déjà pris — mais pour l'indirection : <code>!P</code> valait le <code>*P</code> de C. Quand Ken Thompson écrit B vers 1969, il lui faut un « différent de » ; <code>!</code> fait partie des rares signes qu'aucun langage n'a accaparés. <code>!=</code> naît là, et le <code>!</code> seul suit naturellement. C garde le tout, en réservant <code>~</code> au complément binaire.
