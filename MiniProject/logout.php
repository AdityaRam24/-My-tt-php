<!DOCTYPE html>
<html>
<head>
    <title>Thank You For Using ACR portal</title>
    <link rel="stylesheet" href="logout.css">
    <script>
    function preventHistoryBack() {
        // // Manipulate browser history to prevent going back
        // history.pushState(null, null, location.href);
        // window.onpopstate = function () {
        //     history.go(1);
        // };

        window.history.forward();

    }
    setTimeout("preventHistoryBack()",0);
    window.onunload = function(){null};
</script>
</head>
<body>
    
    <img class="logo" src="VITVL2_1.png" alt="logout">
    <h1>You have Logged Out</h1>
    <p>Thank you for using ACR Portal</p>
    <a href="allog.php">Login In Again</a>
    
</body>
</html>



<!-- <!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
</head>
    <script>
        // Clear session history
        history.replaceState(null, null, location.href);
        history.pushState(null, null, location.href);

        window.onpopstate = function(event) {
            history.go(1);
        };
    </script>
<body>

    
    <img class="logo" src="VITVL2_1.png" alt="logout">
    <h1>You have Logged Out</h1>
    <p>Thank you for using ACR Portal</p>
    <a href="allog.php">Login In Again</a>
    

</body>
</html> -->
