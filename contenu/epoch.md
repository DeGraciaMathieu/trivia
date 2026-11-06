---
ordre: 32
terme: "1<sup>er</sup> janvier 1970"
categorie: "Unix"
date: "1971 — Bell Labs"
teaser: "Une date choisie parce qu'elle était ronde et proche, pas pour sa signification."
retenir: "Une origine arbitraire devient un repère universel dès que tout le monde compte à partir d'elle."
aujourdhui: "Sur 32 bits signés, le compteur déborde le 19 janvier 2038. Le sujet est traité depuis longtemps sur les systèmes modernes, beaucoup moins dans l'embarqué."
---
Le premier Unix compte le temps en soixantièmes de seconde depuis le 1<sup>er</sup> janvier 1971. Le compteur tient sur un mot de 32 bits, ce qui donne… environ deux ans et demi avant débordement. Intenable.

L'équipe passe donc à la seconde comme unité, ce qui repousse le problème de plus d'un siècle, et en profite pour reculer l'origine à une date ronde juste avant l'existence du système : le 1<sup>er</sup> janvier 1970. Il n'y a aucune symbolique là-dedans, c'est un choix de commodité.

Cette date est devenue l'origine du temps pour la quasi-totalité de l'informatique : Unix, Linux, macOS, Java, JavaScript, les bases de données, les API. Elle est aussi la raison pour laquelle une valeur de date vide s'affiche si souvent comme le 1<sup>er</sup> janvier 1970.
