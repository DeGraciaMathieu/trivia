---
ordre: 29
terme: "if … else"
categorie: "Langages & outils"
date: "1957 (FORTRAN) — 1960 (ALGOL)"
teaser: "Le mot vient des logiciens. Le <code>else</code>, lui, n'existe pas en logique : c'est une invention de programmeur."
retenir: "On a hérité de la logique la condition, mais l'alternative, il a fallu l'inventer."
aujourdhui: "Rien n'était joué : Lisp branche avec <code>cond</code>, APL avec une flèche, l'assembleur saute. Et le shell écrit <code>if … fi</code> parce que Steve Bourne venait d'ALGOL 68, où un bloc se referme sur son mot-clé inversé. <code>case … esac</code> n'a pas d'autre justification que la biographie de son auteur."
---
« Si P alors Q » est la façon d'écrire l'implication chez Boole, Frege et Russell. Les premiers langages empruntent la paire <i>if… then</i> en bloc, telle quelle. Rien n'a été inventé ici, juste recopié d'un siècle de notation mathématique.

Mais le premier IF n'a ni <i>then</i> ni booléen. FORTRAN, en 1957, propose l'<b>IF arithmétique</b> : <code>IF (X) 10, 20, 30</code> saute à l'étiquette 10 si X est négatif, 20 s'il est nul, 30 s'il est positif. C'est un branchement à trois voies calqué sur les instructions de l'IBM 704, sans aucune notion de vrai ou de faux. Le IF logique n'arrive qu'en 1962.

C'est ALGOL qui fixe la forme actuelle — et qui ajoute le <code>else</code>. Or l'implication logique n'a pas d'alternative : « si P alors Q » ne dit rien du cas où P est faux. Le <code>else</code> ne vient d'aucune tradition, il vient du fait qu'un programme doit bien faire quelque chose dans l'autre cas. Il apporte avec lui, dès le premier jour, le <i>dangling else</i> — à quel <code>if</code> se rattache un <code>else</code> isolé ? — qu'on paie encore en accolades obligatoires.
