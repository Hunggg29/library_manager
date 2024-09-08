<head>
<link rel="stylesheet" href="css/userstyle.css">
</head>
<div class="user_header">
    <p><?php echo "Hello ". $_SESSION["typeaccount"] ." ". $_SESSION["accountname"]; ?></p>
    <div class ="optionaluser">
        <ul>
            <li class = "logout" style = "font-size:12px;"><a href = "logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
            <li class = "profile" style = "font-size:12px;"><a href = "../profile/index.php"><i class="fas fa-user"></i>Profile</a></li>
            <li class = "borrowing book" style = "font-size:11px;"><a href = "accountindex/borrowingbook.php"><i class="fas fa-book-reader"></i>Borrowing</a></li>
        </ul>
    </div>
</div>
