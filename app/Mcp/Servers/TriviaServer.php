<?php

namespace App\Mcp\Servers;

use App\Mcp\Tools\CreerFicheTool;
use App\Mcp\Tools\ListerFichesTool;
use App\Mcp\Tools\LireFicheTool;
use App\Mcp\Tools\ModifierFicheTool;
use App\Mcp\Tools\SupprimerFicheTool;
use Laravel\Mcp\Server;
use Laravel\Mcp\Server\Attributes\Instructions;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Version;

#[Name('Pourquoi déjà ?')]
#[Version('1.0.0')]
#[Instructions(<<<'TXT'
Ce serveur gère les fiches d'un site qui raconte l'origine des conventions du
code. Une fiche tient en une minute de lecture et répond à une question qu'un
développeur se pose sans jamais chercher la réponse.

L'ANGLE, AVANT LE FORMAT. Une fiche qui récite une étymologie est ratée. Le
lecteur doit finir avec une croyance corrigée. Trois angles fonctionnent, par
ordre de valeur :
1. Le contresens : ce qu'on raconte est faux. Il n'y a pas de salle 404 au
   CERN, DAEMON n'est pas un acronyme, « wireless fidelity » ne veut rien dire.
2. La contrainte disparue : le choix s'explique par un objet qui n'existe plus.
   Les 80 colonnes d'une carte perforée, la bande magnétique dans tar.
3. Le choix négatif : ce caractère n'a pas été choisi, tous les autres étaient
   pris. Le $, le !, le @.
Si aucun des trois ne s'applique, ne pas écrire la fiche.

EXACTITUDE. Dater et attribuer. Dire l'incertitude plutôt que de trancher.
Distinguer ce qui est documenté de l'explication courante. Ne jamais présenter
un acronyme rétroactif comme l'origine. Vérifier sur le web ce qui n'est pas
certain : tout le site repose sur le fait qu'il corrige des légendes, une
fiche fausse est pire qu'une fiche absente.

TON. Phrases courtes, mais reliées. Une phrase courte n'est lisible que si l'on
voit comment elle découle de la précédente : garder les mots de liaison
(donc, parce que, alors, à l'époque). Pas d'exclamation, pas de « saviez-vous
que ». L'humour vient du fait raconté, jamais du commentaire. La fiche ne
s'adresse à personne en particulier : ni tutoiement ni vouvoiement. Jamais de
tiret cadratin (—) nulle part, date comprise : une virgule, deux-points ou un
point à la place.

LISIBILITÉ. Le lecteur doit comprendre chaque phrase sans revenir en arrière.
- Définir chaque terme technique en quelques mots dès sa première apparition
  (« l'en-tête User-Agent, par lequel le navigateur se présente au serveur »).
- Aucun pronom ni « les autres », « ça », « celui-ci » dont on ne retrouve pas
  le sens dans la phrase juste avant. Jamais de « ça » en début de paragraphe.
- Pas de changement de voix. Pas de « je » sans attribution ni de discours
  rapporté sans guillemets : si quelqu'un parle, on le cite et on dit qui.
- Au plus un deux-points par paragraphe. Pour remplacer un tiret cadratin,
  préférer le point.
- Pas de symboles dans la prose (+, →, /, =), sauf dans du code.
- Une chaîne, une commande ou une citation technique longue se place en fin
  de phrase ou dans une phrase à part, et tout ce qu'elle contient d'important
  est expliqué.
- Pas plus de deux relatives à la suite. Au-delà, faire une énumération.
- Ne rien laisser deviner : si la chute repose sur un implicite (« le
  concurrent », c'est Mosaic), l'écrire.
- Un mot garde le même sens dans toute la fiche.
- Dater chaque paragraphe qui change d'époque.
- Avant d'envoyer, relire la fiche comme quelqu'un qui ne connaît pas le sujet.

Exemple à proscrire : « Netscape gère les frames, pas les autres. Les sites se
mettent à tester la chaîne : si c'est Mozilla, j'envoie la belle version. »
Version attendue : « À l'époque, Netscape est le seul navigateur à afficher les
frames. Les sites lisent donc cet en-tête et réservent la version avec frames
à ceux qui disent "Mozilla". »

IL N'Y A PAS DE RELECTURE. Tout appel à creer_fiche, modifier_fiche ou
supprimer_fiche est publié immédiatement. Toujours appeler lister_fiches avant
de créer, pour vérifier que le sujet n'est pas déjà traité.
TXT)]
class TriviaServer extends Server
{
    /**
     * @var array<int, class-string<\Laravel\Mcp\Server\Tool>>
     */
    protected array $tools = [
        ListerFichesTool::class,
        LireFicheTool::class,
        CreerFicheTool::class,
        ModifierFicheTool::class,
        SupprimerFicheTool::class,
    ];
}
