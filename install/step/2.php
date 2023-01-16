<?php

		global $db;

		if ($db) {
			$tables = $db->selectAll("SHOW TABLES;");
			
			success(2, "Genereer Database");

			if (!count($tables)) {
			
				$schema = file_get_contents("schema.sql");

				$queries = explode(";", $schema);

				foreach ($queries as $sql) {
					if (trim($sql)) {
						$db->query($sql);
					}
				}

				$data = file_get_contents("data.sql");

				$queries = explode(";", $data);

				foreach ($queries as $sql) {
					if (trim($sql)) {
						$db->query($sql);
					}
				}

			}

			$hash = hashDirectory("../class/");
			$settings = new Settings();
			$settings->update("glCoreHash", $hash);

			echo '<ol>
				<li>Database schema gegenereerd!</li>
				<li>Standaard data ingevoegd!</li>
			</ol>';




		} else {
			heading(2, "Genereren Database");
		}