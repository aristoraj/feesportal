<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>vlbjcas</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="loginForm">
    <div class="swith-button">
      <a class="login active">Student</a>
      <a class="login active">Admin</a>
    </div>
    <div class="logo"><img src="vlb.png" alt=""></div>
    <div class="title">VLBJCAS<span></span></div>
    <form action="pay.php" method="post">
        <input type="text" class="name" name="customername" placeholder="Full Name" />
        <input type="text" class="rollno" name="email" placeholder="Roll No" />
        <input type="text" class="dep" name="contactno" placeholder="Department" />
        <input type="text" class="amount" name="price" placeholder="Amount" />
        <button class="submit">Pay now</button>
    </form>
  </div>

</body>

</html>