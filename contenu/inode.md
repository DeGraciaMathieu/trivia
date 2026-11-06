---
ordre: 52
terme: "inode"
categorie: "Unix"
date: "1970 — origine incertaine"
teaser: "Interrogé sur le « i », Dennis Ritchie a répondu qu'il ne s'en souvenait pas vraiment."
retenir: "Le nom du fichier n'est pas une propriété du fichier."
aujourdhui: "Tout le comportement déroutant des liens durs, du <code>rm</code> qui ne libère rien, et d'un fichier supprimé mais toujours ouvert découle de ce seul découpage."
---
L'inode est la structure qui décrit un fichier : sa taille, ses droits, ses dates, et l'emplacement de ses blocs. Ce qu'elle ne contient pas, c'est le nom — le nom vit dans le répertoire, qui n'est qu'une table associant des noms à des numéros d'inode.

D'où toute la logique des liens : plusieurs noms peuvent pointer vers le même inode, et supprimer un fichier ne fait que retirer une entrée du répertoire. Le contenu ne disparaît que lorsque plus aucun nom ne le désigne.

Quant au <b>i</b>, Ritchie lui-même a répondu, des années plus tard, qu'il n'en était pas sûr : probablement <i>index</i>, en référence à la table plate où étaient rangées ces structures. L'hésitation vient de l'auteur, pas des commentateurs.
