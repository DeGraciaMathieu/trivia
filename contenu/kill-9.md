---
ordre: 26
terme: "kill -9"
categorie: "Unix"
date: "années 1970 — table des signaux"
teaser: "Le 9 n'a aucune signification. C'est juste sa place dans la liste."
retenir: "Le numéro est arbitraire. L'absence de négociation, non."
aujourdhui: "Même distinction dans Docker et Kubernetes : SIGTERM, on attend la période de grâce, puis SIGKILL. Le <code>-9</code> est le moment où l'on renonce."
---
<code>kill</code> ne tue rien : il envoie un signal. Par défaut SIGTERM, qui veut dire « termine-toi, s'il te plaît ». Le programme peut l'intercepter, fermer ses fichiers, vider ses tampons, et sortir proprement.

SIGKILL est le neuvième de la table des signaux, sans plus de raison que l'ordre dans lequel ils ont été écrits. Sa particularité n'est pas son numéro : c'est qu'il est traité par le noyau, sans que le processus soit prévenu. Il ne peut ni l'intercepter, ni l'ignorer.

D'où le réflexe du <code>-9</code> systématique, qui est presque toujours une erreur : on prive le programme de sa chance de se fermer correctement, et on laisse derrière soi des verrous, des fichiers temporaires et des transactions en vol.
