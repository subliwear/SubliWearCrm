<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Support Message</title>
    <style>
        /* Styles CSS pour la mise en page */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .logo {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
        .message {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="http://127.0.0.1:8000/assets/img/logoSWCRM1.png" class="block" width="50" style="width: 50%; height: auto;">
        <h1>New Support Message</h1>
        <div class="message">
            <p><strong>Subject:</strong> {{$subject}}</p>
            <p><strong>Message:</strong> {{$message}}</p>
            <p><strong>User name:</strong> {{$user->name}}</p>
            <p><strong>User email:</strong> {{$user->email}}</p>
        </div>
        <p>Merci,<br>Subliwear Support</p>
    </div>
</body>
</html>


