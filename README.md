## Installation

On a besoin pour ce projet d'avoir npm et node

Après on installe laravel avec
```bash
 composer global require laravel/installer
```
Installer les dépendences dans le projet avec
```bash
 composer install
```
Lancer notre serveur local
```bash
 php artisan serve --port=9000
```


## Fonctionnement
Dans notre porjet, on a créé une classe ContactController avec
```bash
 php artisan make:controller ContactController
```
Et une classe ContactMail
```bash
 php artisan make:mail ContactMail
```
vu qu'on a ajouté les captcha key dans .env, on fait la commande
```bash
 require google/recaptcha '~1.1'
```
Qui ajoute de nouveaux packages au composeur.json

Dans la classe Contact on vérifie le formulaire dans la fonction sendMail
```bash
     $details = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'phone' => 'required|digits:10',
            'msg' => 'required|max:255',
            'g-recaptcha-response' => new Captcha(),
        ]);
```
on envoie le mail

```bash
Mail::to('testlucasramis@gmail.com')->send(new ContactMail($details));
```
et on renvoie l'infomation que le formulaire a bien été envoyé pour l'afficher après
```bash
return back()->with('message_sent', 'Your message has been sent successfully !');
```
Les routes créées
```bash
Route::get('/contact-us',[ContactController::class,'contact']);
Route::post('/send-message',[ContactController::class,'sendEmail'])->name('contact.send');
```

Dans la fonction passes de l'objet Captcha on instancie un nouvel objet Recaptcha :

```bash
    public function passes($attribute, $value)
    {
        $recaptcha = new ReCaptcha(env('CAPTCHA_SECRET'));
        $response = $recaptcha->verify($value, $_SERVER['REMOTE_ADDR']);
        return $response->isSuccess();

    }
```
Et on renvoie un message si le captcha n'est pas coché
```bash
    public function message()
    {
        return 'Please complete the recaptcha to submit the form.';
    }
```

## Version
Recaptcha<br>v1.2.4

laravel/framework<br>v8.40.0
Pour voir toutes les versions dans le package composer dans le terminal
```bash
composer show
```
Le mail utilisé pour tester est :
```bash
mail : testlucasramis@gmail.com
mdp : 1234$Test
```
