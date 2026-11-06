---
ordre: 38
terme: "chmod 777"
categorie: "Unix"
date: "années 1970 — Unix"
teaser: "Ce n'est pas un nombre magique. C'est trois fois « tous les bits »."
retenir: "Une base de numération n'est qu'un découpage de bits en paquets."
aujourdhui: "Une fois qu'on a vu les trois paquets, on ne relit plus jamais <code>chmod 755</code> de la même façon. Et <code>chmod 777</code> se traduit littéralement : tout le monde peut tout faire."
---
Les droits d'un fichier tiennent en neuf bits : lecture, écriture, exécution, pour le propriétaire, le groupe, et les autres. Trois paquets de trois.

Or l'octal, c'est exactement un chiffre pour trois bits. Un chiffre par paquet, et le tour est joué : 7 c'est 111, tous les droits ; 6 c'est 110, lire et écrire ; 4 c'est 100, lecture seule. <code>644</code> et <code>755</code> ne sont pas des incantations, ce sont des tableaux de bits lus à voix haute.

Si c'est de l'octal et pas de l'hexadécimal, c'est que l'Unix des origines vivait sur des PDP dont toute la culture — adresses, codes d'instruction, vidages mémoire — était octale.
