<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$owner_name = $shop_name = $address = $contact_number = "";
$owner_name_err = $shop_name_err = $address_err = $contact_number_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    // Validate name
    $input_owner_name = trim($_POST["owner_name"]);
    if(empty($input_owner_name)){
        $owner_name_err = "Please enter a name.";
    } elseif(!filter_var($input_owner_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $owner_name_err = "Please enter a valid name.";
    } else{
        $owner_name = $input_owner_name;
    }

    $input_shop_name = trim($_POST["shop_name"]);
    if(empty($input_shop_name)){
        $shop_name_err = "Please enter a name.";
    } elseif(!filter_var($input_shop_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $shop_name_err = "Please enter a valid name.";
    } else{
        $shop_name = $input_shop_name;
    }
    
    // Validate address address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    
    // Validate salary
    $input_contact_number = trim($_POST["contact_number"]);
    if(empty($input_contact_number)){
        $contact_number_err = "Please enter the Contact Number.";     
    } elseif(!ctype_digit($input_contact_number)){
        $contact_number_err = "Please enter a valid number.";
    } else{
        $contact_number = $input_contact_number;
    }
    
    // Check input errors before inserting in database
    if(empty($owner_name_err) && empty($shop_name_err) && empty($address_err) && empty($contact_number_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO customers (owner_name, shop_name, address, contact_number) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_owner_name, $param_shop_name, $param_address, $param_contact_number);
            
            // Set parameters
            $param_owner_name = $owner_name;
            $param_shop_name = $shop_name;
            $param_address = $address;
            $param_contact_number = $contact_number;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: customer.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add customer record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Owner_Name</label>
                            <input type="text" name="owner_name" class="form-control <?php echo (!empty($owner_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $owner_name; ?>">
                            <span class="invalid-feedback"><?php echo $owner_name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Shop_Name</label>
                            <input type="text" name="shop_name" class="form-control <?php echo (!empty($shop_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $shop_name; ?>">
                            <span class="invalid-feedback"><?php echo $shop_name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" name="contact_number" class="form-control <?php echo (!empty($contact_number_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contact_number; ?>">
                            <span class="invalid-feedback"><?php echo $contact_number_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="customer.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>