---
ordre: 57
terme: "mock, stub, fake, spy"
categorie: "Méthodes"
date: "2007 — la taxonomie"
teaser: "Quatre mots employés comme synonymes, qui désignent quatre choses différentes."
retenir: "Poser un état ou vérifier un appel : ce ne sont pas les mêmes tests."
aujourdhui: "Quand une suite de tests casse à chaque remaniement sans qu'aucun comportement n'ait changé, c'est presque toujours qu'on a utilisé des mocks là où des stubs suffisaient."
---
Gerard Meszaros, puis Martin Fowler, ont posé le vocabulaire des <i>doublures de test</i>. Le <b>stub</b> retourne des réponses toutes faites : on l'utilise pour poser un état. Le <b>mock</b> attend qu'on l'appelle d'une certaine manière et fait échouer le test sinon : on l'utilise pour vérifier un comportement.

La différence est celle entre vérifier un résultat et vérifier une interaction. Un test bâti sur des mocks affirme que le code a appelé telle méthode dans tel ordre — ce qui revient à figer l'implémentation dans le test.

Le <b>fake</b> est une implémentation réelle mais simplifiée, comme un dépôt en mémoire. Le <b>spy</b> laisse passer l'appel tout en l'enregistrant.
