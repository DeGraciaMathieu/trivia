---
ordre: 51
terme: "fork"
categorie: "Unix"
date: "1963 — avant Unix"
teaser: "L'embranchement d'une route. Le mot est plus vieux qu'Unix, et décrit un chemin qui se divise."
retenir: "Le mot décrit la trajectoire, pas la duplication."
aujourdhui: "La métaphore tient toujours : un fork réussi est celui dont on n'attend plus qu'il rejoigne la route principale."
---
<i>Fork</i>, en anglais, c'est la fourche d'une route ou d'un cours d'eau : un chemin unique qui devient deux. Melvin Conway utilise le couple <i>fork</i> / <i>join</i> dès 1963 pour décrire des calculs qui se séparent puis se rejoignent.

Unix reprend le mot et le rend brutalement littéral : <code>fork()</code> duplique le processus appelant. Les deux copies repartent du même point, avec la même mémoire, et ne se distinguent que par la valeur retournée. Il n'y a pas de programme fils à désigner : c'est le même, dédoublé.

C'est aussi pour ça que forker un dépôt se dit ainsi. Ce n'est pas une copie, c'est un embranchement — un historique commun, deux suites.
