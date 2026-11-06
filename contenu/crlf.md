---
ordre: 15
terme: "\r\n"
categorie: "Matériel"
date: "machine à écrire, puis téléscripteur"
teaser: "Deux caractères parce qu'il y avait deux gestes mécaniques distincts."
retenir: "On encode encore aujourd'hui le temps de trajet d'un chariot métallique."
aujourdhui: "HTTP, SMTP, IMAP : tous imposent CRLF dans leurs en-têtes. Votre requête HTTP contient, littéralement, des retours chariot."
---
Sur une machine à écrire, aller à la ligne, c'est deux mouvements : ramener le chariot à gauche (<b>carriage return</b>) et faire avancer le papier d'un cran (<b>line feed</b>). Deux gestes, donc deux codes de contrôle sur les téléscripteurs.

Le retour chariot était lent — quelques dixièmes de seconde — et le caractère suivant risquait d'être imprimé pendant le trajet. Envoyer CR puis LF laissait mécaniquement le temps au chariot d'arriver.

Unix a tranché : un seul caractère, LF, et le pilote de terminal se débrouille. CP/M a gardé les deux, MS-DOS a copié CP/M, Windows a copié MS-DOS. La guerre des fins de ligne vient de là.
