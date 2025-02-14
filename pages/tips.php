<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>FitForFun - Tips</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <link href="../img/favicon.ico" rel="icon">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
    
        <!-- I used a custom bootstrap cause i felt like it. DONT CHANGE ANYTHING. Kind regards
         Hernan -->
        <link href="../css/style.min.css" rel="stylesheet">
    </head>
    <body class="bg-white">
        <div id="navbar-placeholder"></div>
    
        <script>
            fetch('../shared/navbar.php')  // Adjusted path to the 'shared' folder
                .then(response => response.text())
                .then(data => {
                    document.getElementById('navbar-placeholder').innerHTML = data;
                })
                .catch(error => console.error('Error loading navbar:', error));
        </script>
    </div>
    
                        <!--Tips here nigga-->


<!--Footer-->
<div id="footer-placeholder"></div>

<script>
    fetch('../shared/footer.html')  // Adjusted path to the 'shared' folder
        .then(response => response.text())
        .then(data => {
            document.getElementById('footer-placeholder').innerHTML = data;
        })
        .catch(error => console.error('Error loading navbar:', error));
</script>

</body>
</html>