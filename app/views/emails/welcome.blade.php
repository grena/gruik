<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Welcome on Gruik !</h2>

        <div>
            Hi <strong>{% $user->username %}</strong> ! Thank you for your registration on <a href="{% URL::to('/') %}">Gruik</a> !
        </div>
    </body>
</html>
