---
ordre: 45
terme: "creat()"
categorie: "Unix"
date: "1970 — économie de frappe"
teaser: "Dennis Ritchie a dit que son plus grand regret était d'avoir enlevé le « e »."
retenir: "Le nom d'une commande décrit la structure de données, pas l'intention de l'utilisateur."
aujourdhui: "C'est pour ça que <code>stat</code> renvoie un <code>st_mode</code> où le type de fichier et les droits cohabitent dans la même valeur — et que <code>chmod</code> ne peut pas toucher au type, pourtant encodé juste à côté."
---
Sur un téléscripteur, on tape dix caractères par seconde, avec des touches qui demandent une vraie pression, et chaque lettre est imprimée sur du papier. Thompson a explicitement conçu Unix pour réduire le nombre de caractères frappés. D'où <code>cat</code>, <code>ls</code>, <code>cp</code>, <code>mv</code>, <code>rm</code>, <code>ln</code> — et l'appel système <code>creat()</code>, amputé d'une lettre.

La troncature suit souvent des familles cohérentes, ce qui se voit dès qu'on les aligne : <code>chmod</code>, <code>chown</code>, <code>chgrp</code>, <code>chdir</code>. Le <b>ch</b>, c'est <i>change</i>, et le reste dit quoi.

Ce qui laisse le vrai mot à expliquer dans <code>chmod</code> : le <b>mode</b>. C'est le nom d'un champ de l'inode, seize bits qui décrivent comment le fichier peut être utilisé — son type et ses neuf bits de droits. « Mode » au sens matériel des années 60 : l'état de fonctionnement d'un dispositif. <code>chmod</code> ne change pas des permissions, il modifie un mot de mode.
