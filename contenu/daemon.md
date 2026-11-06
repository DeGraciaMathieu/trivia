---
ordre: 2
terme: "daemon"
categorie: "Unix"
date: "1963 — MIT, projet MAC"
teaser: "Ni un démon, ni un worker : un petit esprit grec qui trie vos octets pendant votre sommeil."
retenir: "Un worker fait un travail. Un daemon attend qu'on ait besoin de lui."
aujourdhui: "« Worker » a gagné côté applicatif (files de jobs, processus éphémères), « daemon » reste côté système : sshd, httpd, systemd. Le <b>d</b> final, c'est lui."
---
L'équipe de Fernando Corbató, au MIT, écrit les premiers programmes qui tournent en tâche de fond sur CTSS. Il leur faut un nom. Ils pensent au <b>démon de Maxwell</b> : cette créature imaginaire de la thermodynamique qui, infatigable et invisible, trie les molécules une par une.

Le mot vient du grec <i>daimōn</i> : un esprit intermédiaire, ni bon ni mauvais, qui agit en arrière-plan. Rien à voir avec le diable — la petite mascotte cornue de BSD est un jeu de mots venu bien après.

Quant à « Disk And Execution MONitor », l'acronyme qu'on lit partout : c'est une reconstruction a posteriori. Personne n'a nommé ça comme ça en 1963.
