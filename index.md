## Installation

On a besoin pour ce projet d'avoir npm et node

Après on installe laravel avec
```markdown
composer global require laravel/installer
```

Installer les dépendences dans le projet avec
```markdown
 composer install
```

Lancer notre serveur local
```markdown
 php artisan serve
```

## Fonctionnement

Dans notre porjet, on a créé une classe ContactController avec
```markdown
 php artisan make:controller ContactController
```

Et une classe ContactMail
```markdown
 php artisan make:mail ContactMail
```

vu qu'on a ajouté les captcha key dans .env, on fait la commande
```markdown
 require google/recaptcha '~1.1'
```

Qui ajoute de nouveaux packages au composeur.json

Dans la classe Contact on vérifie le formulaire dans la fonction sendMail

```markdown
 $details = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'phone' => 'required|digits:10',
            'msg' => 'required|max:255',
            'g-recaptcha-response' => new Captcha(),
        ]);
```
