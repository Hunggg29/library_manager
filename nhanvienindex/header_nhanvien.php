<head>
<link rel="stylesheet" href="css/userstyle.css">
</head>
<div class="user_header">
    <p><?php echo "Hello ". $_SESSION["typeaccount"] ." ". $_SESSION["accountname"]; ?></p>
    <div class ="optionaluser">
        <ul>
            <li class = "logout" style = "font-size :12px"><a href = "logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
            <li class = "profile" style = "font-size :12px"><a href = "../profile/index.php"><i class="fas fa-user"></i>Profile</a></li>
            <li class = "receive" style = "font-size :12px"><a href = "nhanvienindex/receive.php"><i class="fas fa-box-open"></i>Received</a></li>
            <li class = "confirmed book" style = "font-size :11px"><a href = "nhanvienindex/confirmedbook.php"><i class="fas fa-check-circle"></i>Confirmed</a></li>
        </ul>
    </div>
</div>
