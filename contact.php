<!DOCTYPE html>
<html>

<head>
    <?php include("head.php"); ?>
    <title>Crypto Cubed - Contact us</title>
</head>

<body>
    <?php include("header.php"); ?>
    <div class="parallaxCONTACTUS">
        <div class="titlepara">
            <h1>CONTACT US</h1>
        </div>
    </div>
    <div class="gridCONTACTUS">

        <div class="contactcont">

            <form action="db\mail.php" method="POST">
                <p>NAME</p>
                <input type="text" name="name">
                <p>EMAIL</p>
                <input type="text" name="email">
                <p>MESSAGE</p>
                <textarea name="message" rows="6" cols="32"></textarea>
                <br />
                <input type="submit" value="Send">
                <!-- replace with ajax -->
            </form>

        </div>

    </div>
    <?php include("footer.php"); ?>
</body>

</html>