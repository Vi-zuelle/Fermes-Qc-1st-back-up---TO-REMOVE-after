<?php

if (isset($_REQUEST['action'])) {
	
	if ($_REQUEST['action'] == "contact_form_request") {

		$required_fields = array("name", "email", "message");
		$pre_messagebody_info = "";
		
		$errors = array();
		$data = array();
		
		parse_str($_REQUEST['values'], $data);
		
		//check for required and assemble message

		if (!empty($data)) {
			foreach ($data as $key => $value) {
				$name = strtolower(trim($key));
				if (in_array($name, $required_fields)) {
					if (empty($value)) {
						
						if ($name == "name") {
							$errors[$name] = "Entrez votre nom";
						}
						
						if ($name == "message") {
							$errors[$name] = "Entrez votre message ";
						}
						
						if ($name == "email") {
							if (!isValidEmail($value)) {
								$errors[$name] = "Entrez un courriel valide";
							}			
						}
					}
				}
			}
		}
		
//        session_start();
//        if (isset($_REQUEST['verify']) AND !empty($_REQUEST['verify'])) {
//            $verify = $_SESSION['verify'];
//			if ($verify != md5($data['verify'])) {
//				$errors["verify"] = "Please enter correctly captcha";
//			}
//			
//        }
        if ($data['captcha']) {
            session_start();
            $verify = $_SESSION['verify'];
            if ($verify != md5($data['verify'])) {
                $errors["verify"] = "entrez correctement le captcha";
            }
        }
		$result = array (
				"is_errors" => 0,
				"info" => ""
			);

		if (!empty($errors)) {
			$result['is_errors'] = 1;
			$result['info'] = $errors;
			echo json_encode($result);
			exit;
		}

		$ourMail = $data['emailAddress'];
		$pre_messagebody_info .= "<strong>Nom</strong>" . ": " . $data['name'] . "<br />";
		$pre_messagebody_info .= "<strong>Courriel</strong>" . ": " . $data['email'] . "<br />";
		$pre_messagebody_info .= "<strong>Site web</strong>" . ": " . $data['website'] . "<br />";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers.= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers.= "de: " . $data['email'] . "\r\n";

		$after_message = "\r\n<br />--------------------------------------------------------------------------------------------------\r\n<br /> This mail was sent via contact form";

		if (mail($ourMail, "Courrier en provenance du site FERMES QU?BEC", $pre_messagebody_info .="<strong>Message</strong>" . ": " . nl2br($data['message']) . $after_message, $headers)) {
			$result["info"] = "success";
		} else {
			$result["info"] = "server_fail";
		}

		echo json_encode($result);
		exit;
	}
}

function isValidEmail($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}
?>