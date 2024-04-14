<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AAC</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="VITVL2_1.png" alt="Logo" >
            </div>
            <div class="icons">
                <i class="far fa-bell"></i>
                <i class="far fa-envelope"></i>
                <i class="far fa-comment"></i>
            </div>
        </header>
        <nav>
            <ul>
                <li><a href="#" onclick="loadContent('slots.php')">Slots</a></li>
                <li><a href="#" onclick="loadContent('cal.php')">My TT</a></li>
                <li><a href="#" onclick="loadContent('codinator.php')">SLOTS</a></li>
                <li><a href="http://localhost/test/adminlogin.php" >Logout</a></li>
            </ul>
        </nav>
        <main>
            <section class="content">
                <h1>Welcome to My Time Table ,student Name </h1>
                <p>This is your personalized dashboard.</p>
                <div id="dynamic-content"></div>
            </section>
        </main>
        <footer>
            <p>Contact Site Support</p>
            <p>You are logged in as <span>Student Name</span></p>
        </footer>
    </div>

    <script>
        function loadContent(page) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("dynamic-content").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", page, true);
            xhttp.send();
        }
    </script>
</body>
</html>
