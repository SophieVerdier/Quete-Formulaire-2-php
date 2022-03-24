<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Formulaire</title>
  <link rel="stylesheet" href="style.css">

</head>

<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$name = isset($_POST['name'])? $_POST['name']:'';
$email = isset($_POST['email'])? $_POST['email']:'';
$telephone = isset($_POST['telephone'])? $_POST['telephone']:'';
$sujet = isset($_POST['sujet'])? $_POST['sujet']:'';
$message = isset($_POST['message']) ? $_POST['message']:'';

// define variables and set to empty values
$nameErr = $emailErr = $telephoneErr= $sujetErr = $messageErr= "";
$name = $email = $telephone = $sujet = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["telephone"])) {
    $telephoneErr = "Telephone is required";
  } else {
    $telephone = test_input($_POST["telephone"]);
    // check if name only contains letters and whitespace
    if (!filter_var($telephone, FILTER_SANITIZE_NUMBER_INT)) {
      $telephoneErr = "Only numbers allowed";
    }
  }

  if (empty($_POST["sujet"])) {
    $sujetErr = "Subject is required";
  } else {
    $sujet = test_input($_POST["sujet"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$sujet)) {
      $sujetErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["message"])) {
    $messageErr = "Message is required";
  } else {
    $message = test_input($_POST["message"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$message)) {
      $messageErr = "Only letters and white space allowed";
    }
  }


  if($nameErr == '' && $emailErr=='' && $telephoneErr==''&& $sujetErr=='');{
    include ('./thanks.php');
  }

}

?>

<form method="post" >
    <div>
      <label  for="nom">Nom :</label>
      <input  type="text"  id="name" required  name="name" value="<?php echo $name ?>">;
      <?php echo $nameErr; ?> 
        
    </div>
    <div>
      <label  for="email">Email :</label>
        <input  type="email"  id="email" required  name="email" value ="<?php echo $email ?>">;
      <?php echo $emailErr; ?> 
  
    </div>
    <div>
    <label  for="telephone">N° de téléphone :</label>
    <input  type="text"  id="telephone" required name="telephone" value="<?php echo $telephone ?>">;
      <?php echo $telephoneErr; ?> 
       </div>
    
    <div>
    <label for="sujet">Choisissez un sujet:</label>
<select name="sujet" id="sujet" required value="<?php echo $sujet ?>">;
      <?php echo $sujetErr; ?> 

    <option value="ecologie">Ecologie</option>
    <option value="politique">Politique</option>
    <option value="Economie">Economie</option>
    <option value="Santé">Santé</option>
</select>
</div>

<div>
      <label  for="message">Message :</label>
      <textarea  id="message" required name="message" value="<?php echo $message ?>"> </textarea>;
      <?php echo $messageErr; ?> 
     
    </div>
    <div  class="button">
      <button  type="submit">Envoyer votre message</button>
    </div>
  </form>

  </html>
