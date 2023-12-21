<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Sign Up</h1>

    <form id="signup" action="" method="post" novalidate>
        <div>
            <label for="name">Name</label>
            <input id="name" type="text" placeholder="Name">
        </div>

        <div>
            <label for="email">Email</label>
            <input id="name" type="text" placeholder="email@example.com">
        </div>

        <div>
            <label for="password">Password</label>
            <input id="password" type="password" placeholder="Password123!">
        </div>

        <div>
            <label for="password_confirm">Confirm Password</label>
            <input id="password_confirm" type="password" placeholder="Repeat password">
        </div>
        <div>
            <button name="bt_submit" type="submit">Submit</button>
        </div>
    </form>
    
</body>
</html>