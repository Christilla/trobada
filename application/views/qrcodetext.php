<html>
<head>
	<title></title>
</head>
<body>
<h1>How to generate QR Code using Codeigniter</h1>
<form action="<?php echo base_url();?>QrController/qrcodeGenerator" method="post">
	<input type="text" name="qrcode_text">
	<button>Submit</button>
</form>
</body>
</html>
