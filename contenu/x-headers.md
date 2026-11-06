---
ordre: 1
terme: "X-Custom-Header"
categorie: "HTTP"
date: "1982 — RFC 822"
teaser: "Le X voulait dire « expérimental, ne comptez pas dessus ». Puis tout le monde a compté dessus."
retenir: "Un nom temporaire est un nom définitif."
aujourdhui: "La RFC 6648 (2012) déconseille formellement le préfixe. On nomme désormais ses en-têtes directement, sans X-. Mais X-Forwarded-For traîne encore dans tous les load balancers de la planète."
---
En 1982, la RFC 822 normalise le format des mails. Elle laisse une porte ouverte : tout champ dont le nom commence par <b>X-</b> est un champ « extension », hors standard, que personne n'est obligé de comprendre. Le X est un marqueur de quarantaine.

La convention saute au format MIME, puis au HTTP. Chacun invente ses en-têtes : X-Forwarded-For, X-Frame-Options, X-Requested-With. Et certains deviennent tellement universels qu'ils sont, de fait, des standards.

C'est le piège. Le jour où l'IETF veut normaliser X-Forwarded-For, il faut choisir : garder un nom qui ment (ce n'est plus expérimental) ou publier « Forwarded » et obliger le monde entier à supporter les deux noms pendant vingt ans. Ils ont fait les deux.
