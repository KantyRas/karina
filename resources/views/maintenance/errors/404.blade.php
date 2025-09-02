<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>404 - Page non trouvée</title>
    <style>
        body {
            background-color: #1c1c1c;
            color: #fff;
            font-family: 'Arial', sans-serif;
            text-align: center;
            padding: 50px;
        }
        img {
            max-width: 400px;
            width: 100%;
            height: auto;
            margin-top: 30px;
        }
        .message {
            font-size: 24px;
            margin-top: 20px;
        }
        .quote {
            font-style: italic;
            margin-top: 10px;
            color: #ccc;
        }
    </style>
</head>
<body>
    <h1>404 - Cette page n'existe pas, retournez en arriere...</h1>
    <div class="message">
        Vous n'avez pas les autorisations pour accéder à cette page mais Chuck Norris Oui !.
    </div>
    {{-- <img src="{{ asset('img/chuck-norris.jpeg') }}" alt="Chuck Norris"> --}}
    <img src="https://media4.giphy.com/media/v1.Y2lkPTc5MGI3NjExazEza3NvZjRnbWdycjJ0aWUzZ2x3cWd1aDRqZHp0c29ma3Z2OXh4cCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/l1J3G5lf06vi58EIE/giphy.gif" alt="Chuck Norris GIF">
    <div class="quote">
        <h1>"Chuck Norris ne cherche pas sur Google. Google demande à Chuck Norris."</h1>
    </div>
</body>
</html>
