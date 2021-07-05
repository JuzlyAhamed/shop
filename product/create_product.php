<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$product_name = $price_code = $unit_price = "";
$product_name_err = $price_code_err = $unit_price = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    // Validate name
    $input_product_name = trim($_POST["product_name"]);
    if(empty($input_product_name)){
        $product_name_err = "Please enter a name.";
    } elseif(!filter_var($input_product_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $product_name_err = "Please enter a valid name.";
    } else{
        $product_name = $input_product_name;
    }

    // $input_price_code = trim($_POST["price_code"]);
    // if(empty($input_price_code)){
    //     $price_code_err = "Please enter a name.";
    // } elseif(!filter_var($input_price_code, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    //     $price_code_err = "Please enter a valid name.";
    // } else{
    //     $price_code = $input_price_code;
    // }
    
    // Validate price_code
    $input_price_code = trim($_POST["price_code"]);
    if(empty($input_price_code)){
        $price_code_err = "Please enter an price code.";     
    } else{
        $price_code = $input_price_code;
    }

    // Validate unit_price 
    $input_unit_price = trim($_POST["unit_price"]);
    if(empty($input_unit_price)){
        $unit_price_err = "Please enter an unit price.";     
    } else{
        $unit_price = $input_unit_price;
    }
    
    // Check input errors before inserting in database
    if(empty($product_name_err) && empty($price_code_err) && empty($unit_price_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO products (product_name, price_code, unit_price) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sii", $param_product_name, $param_price_code, $param_unit_price);
            
            // Set parameters
            $param_product_name = $product_name;
            $param_price_code = $price_code;
            $param_unit_price = $unit_price;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: product.php");
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
                    <p>Please fill this form and submit to add product record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control <?php echo (!empty($product_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $product_name; ?>">
                            <span class="invalid-feedback"><?php echo $product_name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Price code</label>
                            <input type="text" name="price_code" class="form-control <?php echo (!empty($price_code_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price_code; ?>">
                            <span class="invalid-feedback"><?php echo $price_code_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Unit price</label>
                            <input type="text" name="unit_price" class="form-control <?php echo (!empty($unit_price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $unit_price; ?>">
                            <span class="invalid-feedback"><?php echo $unit_price_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="product.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>