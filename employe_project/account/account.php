<?php
include '../inscription/fonctions.php';

// Fetch current user data
$connect = connection_a_la_base();
$stmt = $connect->query("SELECT * FROM c_user LIMIT 1");
$user_data = $stmt->fetch_assoc();

$photo = $user_data['photo'] ?? '';
$nom = $user_data['nom'] ?? '';
$user_type = $user_data['user_type'] ?? '';
$cin = $user_data['cin'] ?? '';
$email = $user_data['email'] ?? '';
$telephone = $user_data['tel'] ?? '';
$description = $user_data['disc'] ?? 'Discription empty';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $user_type = $_POST['user_type'];
    $cin = $_POST['cin'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $description = $_POST['description'];
    
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = 'uploads/' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
    }

    // Update `c_user` table
    $stmt = $connect->prepare("UPDATE c_user SET nom = ?, email = ?, cin = ?, tel = ?, disc = ?, photo = ? WHERE email = ?");
    $stmt->bind_param("sssssss", $nom, $email, $cin, $telephone, $description, $photo, $email);
    $stmt->execute();
    $stmt->close();
    $stmt = $connect->prepare("UPDATE employe SET nom = ?, email = ?, cin = ?, tel = ?, disc = ?, photo = ? WHERE email = ?");
    $stmt->bind_param("sssssss", $nom, $email, $cin, $telephone, $description, $photo, $email);
    $stmt->execute();
    $stmt->close();
}

$connect->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Compte Utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f9;
        }

        h2 {
            text-align: center;
            color: #3c0cb7;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #6c0a52;
        }

        input[type="text"], input[type="email"], input[type="tel"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-bottom: 15px;
        }

        input[type="submit"] {
            background-color: #3c0cb7;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2a099b;
        }

        .photo-preview {
            display: block;
            margin: 0 auto 15px;
            width: 150px;
            height: 150px;
            background-color: #ddd;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h2>Modifier votre compte</h2>
    <form method="post" enctype="multipart/form-data">
        <img src="<?php echo htmlspecialchars($photo); ?>" alt="Photo de profil" class="photo-preview">
        <label for="photo">Photo:</label>
        <input type="file" name="photo" id="photo" accept="image/*">

        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($nom); ?>"> 

        <label for="user_type">User type:</label>
        <input type="text" name="user_type" id="user_type" value="<?php echo htmlspecialchars($user_type); ?>">

        <label for="cin">CIN:</label>
        <input type="text" name="cin" id="cin" value="<?php echo htmlspecialchars($cin); ?>">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>">

        <label for="telephone">Téléphone:</label>
        <input type="tel" name="telephone" id="telephone" value="<?php echo htmlspecialchars($telephone); ?>">

        <label for="description">Description:</label>
        <textarea name="description" id="description"><?php echo htmlspecialchars($description); ?></textarea>

        <input type="submit" value="Mettre à jour">
    </form>
</body>
</html>
