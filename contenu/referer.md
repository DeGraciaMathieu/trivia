---
ordre: 13
terme: "Referer"
categorie: "HTTP"
date: "1995 — la faute est dans la RFC"
teaser: "Il manque un R. Trente ans plus tard, on ne peut toujours pas le remettre."
retenir: "Une faute de frappe devient une spécification dès qu'on l'implémente."
aujourdhui: "Règle mnémotechnique : l'en-tête HTTP a un R, tout le reste en a deux. Il n'y a pas de logique, juste de l'histoire."
---
Le mot anglais s'écrit <b>referrer</b>, avec deux R. Quand Phillip Hallam-Baker propose l'en-tête qui indique la page d'où vient le visiteur, il l'écrit avec un seul. Personne ne relève.

La coquille passe dans la spécification, puis dans les implémentations, puis dans la RFC 1945, puis dans la RFC 2616. À ce stade, corriger l'orthographe reviendrait à casser tous les serveurs du monde.

Le plus beau : les ajouts récents, eux, sont correctement orthographiés. <code>document.referrer</code> en JavaScript, l'en-tête <code>Referrer-Policy</code>. On a donc deux orthographes officielles qui cohabitent, selon la date de naissance du truc.
