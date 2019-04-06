<?php
/**
************* @author Nashon Odhiambo Odiwuor    				      **************
************* Project Name: TaskPay   								  **************
************* Project Type: School Project   						  **************
************* Project Category: Web Application                       **************
************* Project Languages: PHP, HTML, CSS, JAVASCRIPT, AJAX     **************
************* Project Frameworks: Bootstrap, Bootswatch, FontAwesome  **************
*/


#Require database connection file to execute querry
#Include file path
require_once('./databases/database_connect.php');
#Require data tables to reference storage points
require_once('./databases/database_tables.php');


class accounts_class extends database_connection {

	#create constructor class to instantiate the database connection
	function __construct()
	{
		parent::__construct();

		//Declarations and Class instances 
		$accounts_tbl = new app_tables();
		$accounts_tbl->create_account_table();

	}

	#this method cleans user input data
	public function security($input)
	{
		htmlspecialchars($input);
		stripslashes($input);

		return $input;
	}

	/*
	*** Creating a new user record in the Database
	*** Parse first_name, last_name, phone, national_id, email and password
	*/
	public function create_account($first_name, $last_name, $email, $password, $phone, $national)
	{

		$check_data = "SELECT * FROM accounts WHERE email = :email ";
		$prepare_check_data = $this->pdo_connect->prepare($check_data);
		$prepare_check_data->execute(array(":email" => $email));
		$results = $prepare_check_data->rowCount();

		if ($results > 0) {
			#user email already registered. 
			#Redirect user with error message.

			$msg = "Sorry, the email " . $email . " is already registered!";
			header("Location: signup.php?msg=" . $msg);
		}else{
			#add User details to database

			$add_user = "INSERT INTO accounts (first_name, last_name, email, password, phone_number, national_id, date_joined) VALUES (:first, :last, :email, :pass, :phone, :national, :date_join)";

			$prepare_add_user = $this->pdo_connect->prepare($add_user);

			#try insert or throw error incase of error message
			try {
				$data_array = array(":first" => $first_name,
			                        ":last"  => $last_name,
			                        ":email" => $email,
			                        ":pass"  => md5($password),
			                        ":phone" => $phone,
			                    	":national" => $national,
			                    	":date_join" => Date('D, d-M, Y'));

				$prepare_add_user->execute($data_array);

				#redirect user to login after successful insert.
				$msg = $first_name . " Your account was created successfully";
				header("Location: index.php?msg=" . $msg);

			} catch (PDOException $exception) {
				#case of error, redirect user with error message
				header("Location: 504.php?msg=" . $exception->getMessage());
			}
		}
	}


	/*
	*user login function.
	*/
	public function account_login($username, $password)
	{
		$select_user = "SELECT * FROM accounts WHERE email = :user";
		$prepare_select_user = $this->pdo_connect->prepare($select_user);

		#try selecting user details to match against given info
		try {
			$prepare_select_user->execute(array(":user" => $username));

			$results = $prepare_select_user->rowCount();

			#user exists, check password and create session
			if ($results > 0) {
				while ($rows = $prepare_select_user->fetch(PDO::FETCH_ASSOC)) {
					if (md5($password) == $rows['password']) {
						
						$_SESSION['current_session_id'] = $rows['account_id'];
						$_SESSION['current_session_username'] = $rows['first_name'] . " " . $rows['last_name'];
						$_SESSION['session_contact'] = $rows['phone_number'];
						$_SESSION['session_timeout'] = time() + 600;

						setcookie("user_mail", $rows['email'], time()+(60 * 60 * 24 * 365));
						setcookie("user_pass", $password, time()+(60 * 60 * 24 * 365));
						setcookie("my_ID", md5($rows['account_id']), time()+(60 * 60 * 24 * 365));
						setcookie("validate_login_id", $rows['account_id'], time()+(60 * 60 * 24 * 365));
						setcookie("my_User", $rows['first_name'] . " " . $rows['last_name'], time()+(60 * 60 * 24 * 365));

						$msg = "Welcome " . $rows['first_name'];
						header("Location: myapp/?msg=" . $msg);

					}else{
						setcookie("user_mail", $rows['email'], time()+(60 * 60 * 24 * 365));
						$msg = "Wrong Password! Please try again";
						header("Location: index.php?msg=" . $msg);
					}
				}
			}else{
				#account does not exist. Create new account
				$msg = "Account does not exist. Create new Account!";
				header("Location: signup.php?msg=" . $msg);
			}
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}

	}


	/*
	*check forgot password
	*/
	public function check_forgot_password($email)
	{
		$check_email = "SELECT * FROM accounts WHERE email = :email ";
		$prepare_check_email = $this->pdo_connect->prepare($check_email);

		try {
			$prepare_check_email->execute(array(":email" => $email));
			$results = $prepare_check_email->rowCount();

			#user accounts exist
			if ($results > 0) {
				while ($rows = $prepare_check_email->fetch(PDO::FETCH_ASSOC)) {
					header("Location: change_password.php?user_id=" . $rows['account_id']);
				}
			}else{
				#account does not exist. Create new account
				$msg = "Email Address does not exist!";
				header("Location: forgot.php?msg=" . $msg);
			}
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	/*
	*change user password
	*/

	public function change_password($password, $account_id)
	{
		#change user password referencing user account info
		$change_password = "UPDATE accounts SET password = :pass WHERE account_id = :acc_id ";
		$prepare_change_password = $this->pdo_connect->prepare($change_password);

		try {
			$data_array = array(":pass" => md5($password),
		                        ":acc_id" => $account_id);
			$prepare_change_password->execute($data_array);

			#redirect to login page
			$msg = "Password changed succesfully";
			header("Location: index.php?msg=" . $msg);
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}


	/*
	*delete user account
	*/
	public function delete_user($account_id)
	{
		#delete user and all subsequent user data from the database 
		$delete_account = "DELETE FROM accounts WHERE account_id = :acc_id ";
		$prepare_delete_account = $this->pdo_connect->prepare($delete_account);

		try {
			$prepare_delete_account->execute(array(":acc_id" => $account_id));

			#redirect to login page
			$msg = "Your account was deleted succesfully!";
			header("Location: index.php?msg=" . $msg);
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	/*
	*logout
	*/
	public function logout()
	{
		if (session_start()) {
			session_unset();
			session_destroy();

			$msg_p = "Logout Successful";
			header("Location: ../index.php?msg_p=" . $msg_p);

		}
	}


}

?>