---
ordre: 46
terme: "/usr"
categorie: "Unix"
date: "1971 — un disque plein"
teaser: "Ce n'était pas « Unix System Resources ». C'était le dossier des utilisateurs, débordé par accident."
retenir: "Une décision prise pour cause de disque plein survit cinquante ans à ce disque."
aujourdhui: "Les distributions Linux ont passé la décennie 2010 à fusionner <code>/bin</code> dans <code>/usr/bin</code>. Elles ne corrigent pas une architecture : elles annulent un débordement de 1971."
---
Au départ, <code>/usr</code> contient les répertoires personnels : <code>/usr/ken</code>, <code>/usr/dmr</code>. Rien d'autre. C'est bien l'abréviation de <i>user</i>.

Puis le disque système sature. L'équipe a un second disque sous la main — celui des utilisateurs — et y déverse ce qui ne tient plus : des binaires, des bibliothèques. Naissent <code>/usr/bin</code>, <code>/usr/lib</code>. C'est un débordement, pas une architecture.

Le troisième disque a donné <code>/home</code>, et les utilisateurs ont quitté <code>/usr</code> pour de bon. La séparation entre <code>/bin</code> et <code>/usr/bin</code>, elle, est restée, et des générations de documentation ont inventé après coup des justifications élégantes — dont l'acronyme « Unix System Resources », qui n'a jamais existé à l'origine.
