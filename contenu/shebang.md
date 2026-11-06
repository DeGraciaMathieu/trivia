---
ordre: 11
terme: "#!"
categorie: "Unix"
date: "fin des années 1970 — Bell Labs"
teaser: "Deux caractères choisis parce qu'ils ne voulaient rien dire."
retenir: "Une bonne convention reste lisible même par ceux qui l'ignorent."
aujourdhui: "<code>#!/usr/bin/env bash</code> est la version moderne : on ne code plus en dur le chemin de l'interpréteur, on demande au PATH."
---
Dennis Ritchie ajoute au noyau une règle simple : si un fichier exécutable commence par les deux octets <code>#!</code>, ce qui suit est le chemin de l'interpréteur à lancer avec ce fichier en argument.

Le choix des caractères est pragmatique. <code>#</code> était déjà le caractère de commentaire du shell, donc la ligne reste inoffensive si le mécanisme n'existe pas. Le <code>!</code> rend la séquence improbable dans un fichier normal.

Le nom <b>shebang</b> est venu après, par contraction orale : <i>sharp</i> (#) + <i>bang</i> (!). Les Unixiens nomment leurs symboles comme des sons.
