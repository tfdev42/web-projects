<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkt Erstellen</title>
</head>
<body>
    <?php include 'header.inc.php'; ?>
    <main>
        <h1>Produkt erstellen</h1>
        <?php include 'showerrors.inc.php'; ?>
        Bei File-Uploads IMMER enctype="multipart/form-data"
        <form action="admin_create_product.php" method="POST" enctype="multipart/form-data">

        </form>
    </main>
</body>
</html>