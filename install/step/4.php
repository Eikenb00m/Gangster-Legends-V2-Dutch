<?php

		global $db;

		if ($db) {

			$admins = $db->selectAll("SELECT * FROM users WHERE U_userLevel = 2;");
			

			if (!count($admins)) {

				if (isset($_GET["remove"])) {
					success(4, "Remove Installer");
					echo '<ol><li>Directory removed</li></ol>';
					unlink("../install");
					success(5, "Complete!");
					echo '<ol><li>Redirecting you in 5 seconds</li></ol>';
					echo '<script>setTimeout(function () { document.location = "../" }, 5000);';

				} else {
					heading(4, "Remove Installer");
					echo '<a href="?remove=true" class="btn btn-danger">
						Finish Install and remove installer
					</a>';
					heading(5, "Complete!");
				}

			} else {
				heading(4, "Remove Installer");
				heading(5, "Complete!");
			}