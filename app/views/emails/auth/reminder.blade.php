<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>

		<div>
			To reset your password, complete this form: {% link_to_route('passwordReseter', 'reset page', array($token)) %}.
		</div>
	</body>
</html>
