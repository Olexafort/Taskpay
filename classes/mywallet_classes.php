<?php
/**
************* @author Nashon Odhiambo Odiwuor    				      **************
************* Project Name: TaskPay   								  **************
************* Project Type: School Project   						  **************
************* Project Category: Web Application                       **************
************* Project Languages: PHP, HTML, CSS, JAVASCRIPT, AJAX     **************
************* Project Frameworks: Bootstrap, Bootswatch, FontAwesome  **************
*/

class mywallet {

	#declare and set class variables
	private $pdo_connect;

	#create constructor class to instantiate the database connection
	function __construct($database_connection)
	{
		$this->pdo_connect = $database_connection;
	}

	public function deposit_cash($amount, $acc_id)
	{
		#check if there is csh in wallet 
		$check_balance = "SELECT * FROM wallet WHERE account_id = :acc_id ";
		$prepare_check_balance = $this->pdo_connect->prepare($check_balance);

		$prepare_check_balance->execute(array(":acc_id" => $acc_id));
		$results = $prepare_check_balance->rowCount();

		#update or add
		if ($results > 0) {
			while ($rows = $prepare_check_balance->fetch(PDO::FETCH_ASSOC)) {
				#update balance because row already exists
				$update_balance = "UPDATE wallet SET amount = :amt, date_updated = :dt, time_updated = :tt AND status = :sts WHERE account_id = :acc_id ";
				$prepare_update_balance = $this->pdo_connect->prepare($update_balance);

				$array_data = array(":amt" => $amount + $rows['amount'],
									":dt" => Date('D, d-M, Y'),
									":tt" => Date('G:i:s a'),
									":sts" => "Deposit",
			                        ":acc_id" => $acc_id);
				$prepare_update_balance->execute($array_data);

				$msg = "Your account balance was updated successfully!";
				header("Location: someplace.php?msg=" . $msg);
			}
			
		}else{
			#create new wallet row
			$update_balance = "INSERT INTO wallet (amount, date_updated, time_updated, status, account_id) VALUES(:amt, :dt, :tt, :sts, :acc_id)"; 			
			$prepare_update_balance = $this->pdo_connect->prepare($update_balance);

			$array_data = array(":amt" => $amount,
								":dt" => Date('D, d-M, Y'),
								":tt" => Date('G:i:s a'),
								":sts" => "Deposit",
			                    ":acc_id" => $acc_id);
			$prepare_update_balance->execute($array_data);

			$msg = "Your account balance was updated successfully!";
			header("Location: someplace.php?msg=" . $msg);
		}
	}

	#pay 
	public function pay($amount, $client_id, $acc_id)
	{
		#check if there is cash in wallet 
		$check_balance = "SELECT * FROM wallet WHERE account_id = :acc_id ";
		$prepare_check_balance = $this->pdo_connect->prepare($check_balance);

		$prepare_check_balance->execute(array(":acc_id" => $acc_id));
		$results = $prepare_check_balance->rowCount();

		#check actual balance
		if ($results > 0) {
			while ($rows = $prepare_check_balance->fetch(PDO::FETCH_ASSOC)) {
				$balance = $rows['amount'];
				if ($amount > $balance) {
					$msg = "There are insufficient funds in your account. Please deposit " . $amount - $balance . " to make this payment!";
					header("Location: someplace.php?msg=" . $msg);
				}else{
					#update both accounts
					try {
						$update_balance = "UPDATE wallet SET amount = :amt, date_updated = :dt, time_updated = :tt AND status = :sts WHERE account_id = :acc_id ";
						$prepare_update_balance = $this->pdo_connect->prepare($update_balance);

						$array_data = array(":amt" => $balance - $amount,
											":dt" => Date('D, d-M, Y'),
											":tt" => Date('G:i:s a'),
											":sts" => "Payment",
					                        ":acc_id" => $acc_id);
						$prepare_update_balance->execute($array_data);

						#select and update client database
						$select_client_wallet = "SELECT * FROM wallet WHERE account_id = :client ";
						$prepare_select = $this->pdo_connect->prepre($select_client_wallet);
						$prepare_select->execute(array(":client" => $client_id));

						$result_set = $prepare_select->rowCount();
						#do update
						if ($result_set > 0) {
							while ($row = $prepare_select->fetch(PDO::FETCH_ASSOC)) {
								$mybalance = $row['amount'];

								$update_client_wallet = "UPDATE wallet SET amount = :amt, date_updated = :dt, time_updated = :tt AND status = :sts WHERE account_id = :acc_id ";
								$prepare_update_balance = $this->pdo_connect->prepare($update_balance);

								$array_data = array(":amt" => $mybalance + $amount,
													":dt" => Date('D, d-M, Y'),
													":tt" => Date('G:i:s a'),
													":sts" => "Payment Received",
							                        ":acc_id" => $client_id);
								$prepare_update_balance->execute($array_data);

								$msg = "Your account balance was updated successfully!";
								header("Location: someplace.php?msg=" . $msg);
							}
						
						} else{
							#do insert	
							$update_client_wallet = "INSERT INTO wallet (amount, date_updated, time_updated, status, account_id) VALUES(:amt, :dt, :tt, :sts, :acc_id)";
							$prepare_update_balance = $this->pdo_connect->prepare($update_balance);

							$array_data = array(":amt" => $amount,
												":dt" => Date('D, d-M, Y'),
												":tt" => Date('G:i:s a'),
												":sts" => "Payment Received",
						                        ":acc_id" => $client_id);
							$prepare_update_balance->execute($array_data);

							$msg = "Your account balance was updated successfully!";
							header("Location: someplace.php?msg=" . $msg);
						}
					} catch (PDOException $exception) {
						#case of error, redirect user with error message
						header("Location: 504.php?msg=" . $exception->getMessage());
					}
				}
			}
		}else{
			$msg = "Please deposit some money in your account first";
			header("Location: someplace.php?msg=" . $msg);
		}
	}

}

?>