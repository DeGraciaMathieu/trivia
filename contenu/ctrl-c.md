---
ordre: 16
terme: "Ctrl+C"
categorie: "Unix"
date: "années 1960 — ASCII"
teaser: "La touche Control fait exactement ce que son nom dit : elle transforme une lettre en caractère de contrôle."
retenir: "Ctrl n'est pas un modificateur d'application. C'est un opérateur binaire."
aujourdhui: "Copier avec Ctrl+C est venu bien plus tard, dans un autre monde. D'où le conflit permanent dans les terminaux."
---
En ASCII, les 32 premiers codes ne sont pas des lettres mais des commandes pour la machine. La touche Control d'un téléscripteur est un interrupteur câblé : elle efface les bits hauts du caractère tapé. La lettre C (0x43) devient 0x03, soit <b>ETX</b>, « fin de texte ».

Unix s'en sert comme d'un signal : le pilote de terminal voit passer ce caractère et envoie SIGINT au programme au premier plan. Sur les premiers systèmes, c'était souvent la touche DEL qui jouait ce rôle — Ctrl+C s'est imposé par l'usage.

Même mécanique pour les voisins : Ctrl+D envoie 0x04, « fin de transmission », d'où la fin de saisie. Ctrl+Z, 0x1A, la suspension. Ctrl+G, 0x07, faisait sonner une vraie cloche dans le téléscripteur.
