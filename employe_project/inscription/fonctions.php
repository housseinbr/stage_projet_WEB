<?php

function connection_a_la_base() {
    $connect = new mysqli('127.0.0.1', 'root', '', 'Data_Base');
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }
    return $connect;
}

function enregistre_les_information() {
    $nom = trim($_POST['username']);
    $email = trim($_POST['email']);
    $cin = trim($_POST['cin']);
    $password = trim($_POST['password']);
    $user_type = trim($_POST['user_type']);
    $photo = '';
    $disc = '';
    $tel = '';
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $connect = connection_a_la_base();

    $stmt = $connect->prepare("SELECT * FROM employe WHERE email = ? OR nom = ? OR cin = ?");
    if (!$stmt) {
        die("Preparation failed: " . $connect->error);
    }
    $stmt->bind_param("sss", $email, $nom, $cin);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "Email, CIN, or username already exists.";
        $stmt->close();
    } else {
        $stmt->close();

        $stmt = $connect->prepare("INSERT INTO employe (nom, email, cin, tel, disc, user_type, photo, pwd) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Preparation failed for `employe` table: " . $connect->error);
        }
        $stmt->bind_param("ssssssss", $nom, $email, $cin, $tel, $disc, $user_type, $photo, $hashed_password);
        if ($stmt->execute()) {

            $connect->query("TRUNCATE TABLE c_user");
            $stmt->close(); 

            $stmt = $connect->prepare("INSERT INTO c_user (nom, email, cin, tel, disc, user_type, photo) VALUES (?, ?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                die("Preparation failed for `c_user` table: " . $connect->error);
            }
            $stmt->bind_param("sssssss", $nom, $email, $cin, $tel, $disc, $user_type, $photo);
            if ($stmt->execute()) {
                echo "Registration successful!";
            } else {
                echo "Error inserting into `c_user`: " . $stmt->error;
            }
            $stmt->close(); 
        } else {
            echo "Error inserting into `employe`: " . $stmt->error;
        }
    }

    $connect->close();
}

function connection_de_utilisateur() {
    $cin = trim($_POST['cin']); 
    $password = trim($_POST['password']);
    $connect = connection_a_la_base();

    // Vérifier l'existence de l'utilisateur avec le CIN
    $stmt = $connect->prepare("SELECT pwd, email FROM employe WHERE cin = ?");
    if (!$stmt) {
        die("Preparation failed: " . $connect->error);
    }
    $stmt->bind_param("s", $cin);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['pwd'])) {
            $connect->query("TRUNCATE TABLE c_user");
            $email = $row['email'];
            $stmt->close();

            $stmt = $connect->prepare("SELECT * FROM employe WHERE email = ?");
            if (!$stmt) {
                die("Preparation failed: " . $connect->error);
            }
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user_result = $stmt->get_result();
            
            if ($user_result->num_rows > 0) {
                $user_data = $user_result->fetch_assoc();
                $stmt->close();
                $stmt = $connect->prepare("INSERT INTO c_user (nom, email, cin, tel, disc, user_type, photo) VALUES (?, ?, ?, ?, ?, ?, ?)");
                if (!$stmt) {
                    die("Preparation failed for `c_user` table: " . $connect->error);
                }
                $stmt->bind_param("sssssss", $user_data['nom'], $user_data['email'], $user_data['cin'], $user_data['tel'], $user_data['disc'], $user_data['user_type'], $user_data['photo']);
                if ($stmt->execute()) {
                    echo "Connected successfully!";
                } else {
                    echo "Error inserting into `c_user`: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "No user data found.";
            }
        } else {
            echo "Wrong password.";
        }
    } else {
        echo "Wrong CIN.";
    }

    $connect->close();  
}

?>
