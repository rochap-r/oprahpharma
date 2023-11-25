<br>
Bonjour, <b>{{ $name }}</b><br><br>
Votre Compte Utilisateur a été créé avec succès sur la plateforme en ligne :
vous pouvez récupérer les coordonnées de votre compte ci-dessous :
<br><br><br>
<b>Email</b>: {{ $email }}
<br>
<b>Nom</b>: {{ $sname }}
<br>
<b>Mot de passe</b>: {{ $password }}
<br><br>
<a href="{{ route('app.home') }}">Connectez-vous</a>

<br>
<b>Note</b> : Il est recommandé dès votre première connexion de pouvoir changer le mot de passe.
<br><br>
Merci, Bienvenue parmi nous !
