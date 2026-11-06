---
ordre: 69
terme: "notation hongroise"
categorie: "Contresens"
date: "deux notations, une seule ridicule"
teaser: "Celle qu'on moque n'est pas celle qui avait été conçue."
retenir: "Annoter ce que le compilateur ignore, pas ce qu'il vérifie."
aujourdhui: "L'intention d'origine survit sous une autre forme : les types encapsulés, qui empêchent d'affecter un identifiant d'utilisateur à un identifiant de commande. Le compilateur fait le travail que la convention demandait à l'œil."
---
Charles Simonyi préfixait les noms par ce que la valeur <i>signifie</i> : <code>rowIndex</code> et <code>colIndex</code>, ou une chaîne validée contre une chaîne brute. L'intérêt est immédiat : une affectation entre deux préfixes différents devient visiblement suspecte, à la lecture, sans outil.

En passant dans la documentation des API Windows, l'idée a été comprise comme encodant le <i>type</i> : <code>lpszName</code>, <code>dwCount</code>. Or le type, le compilateur le connaît déjà. Cette version n'apporte rien, vieillit mal dès qu'on change un type, et c'est celle dont tout le monde se moque.

La première visait à rendre visible une erreur qu'aucun compilateur ne peut voir. La seconde répète bruyamment ce qu'il sait déjà.
