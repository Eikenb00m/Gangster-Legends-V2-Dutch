<?php

		global $db;

		if ($db) {

			$admins = $db->selectAll("SELECT * FROM users WHERE U_userLevel = 2;");
			if (
				!count($admins) &&
				isset($_POST["email"]) && 
				isset($_POST["user"]) && 
				isset($_POST["pass"]) && 
				isset($_POST["confirm"]) 
			) {

				if ($_POST["pass"] != $_POST["confirm"]) {
					echo '<div class="alert alert-danger">De wachtwoorden komen niet overeen!</div>';
				} else {

					$u = new User();

					$makeUser = $u->makeUser(
	                    $_POST["user"], 
	                    $_POST["email"], 
	                    $_POST["pass"]
	                );

	                if (!ctype_digit($makeUser)) {
	                	echo '<div class="alert alert-danger">'.$makeUser.'</div>';
	                } else {
	                    $_SESSION["userID"] = $makeUser;
	                    $user = new User($makeUser);
	                    $user->set("U_userLevel", 2);
	                }
				}

			}

			$admins = $db->selectAll("SELECT * FROM users WHERE U_userLevel = 2;");
			

			if (!count($admins)) {
				heading(3, "Aanmaken Admin Account");

					echo '
						<div class="panel panel-default">
							<div class="panel-body">
								<form method="post" action="#">
									<div class="form-group">
										<label for="exampleInputEmail1">Email adres</label>
										<input type="text" class="form-control" name="email" value="">
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Gebruikersnaam</label>
										<input type="text" class="form-control" name="user">
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Wachtwoord</label>
										<input type="password" class="form-control" name="pass">
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Bevestig Wachtwoord</label>
										<input type="password" class="form-control" name="confirm">
									</div>
									<div class="text-right">
										<button type="submit" class="btn btn-success">
											Account maken!
										</button>
									</div>

								</form>
							</div>
						</div>
					';

			} else {
				success(3, "Aanmaken Admin Account");
				echo '<ol><li>Admin Account gemaakt</li></ol>';
			}



		} else {
			heading(3, "Aanmaken Admin Account");
		}