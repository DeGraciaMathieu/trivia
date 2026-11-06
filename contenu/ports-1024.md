---
ordre: 12
terme: "port < 1024"
categorie: "Réseau"
date: "1983 — BSD"
teaser: "La sécurité par le privilège : une décision d'université, reprise partout."
retenir: "Une règle de sécurité n'a de sens qu'avec son modèle de menace."
aujourdhui: "C'est pourquoi tant d'images Docker écoutent sur 8080 et laissent le reverse proxy s'occuper du 80 : on évite de tourner en root pour rien."
---
Dans le BSD des années 80, les machines sont partagées entre des utilisateurs qui se connaissent. Le risque, c'est qu'un étudiant lance un faux serveur de mail sur le port 25 pour intercepter le courrier des autres.

La parade est brutale : seuls les processus lancés par root peuvent écouter sur un port inférieur à 1024. Si tu parles au port 80 d'une machine, tu parles à quelqu'un qui avait les droits administrateur.

Le modèle suppose que root est de confiance et que les utilisateurs ne le sont pas. Dans un conteneur qui ne fait tourner qu'une seule application, l'hypothèse ne tient plus du tout.
