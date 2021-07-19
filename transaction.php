<!-- amount transfer -->
  <?php
    $showAlert=false;

    require'dbconfig/config.php';
        $from = $_GET['id'];
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            
            $to = $_POST['to'];
            $amount = $_POST['amount'];

            $sql = "SELECT * FROM `customer` WHERE `sno`= $from";
            $result1 = mysqli_query($con,$sql);
            $row1 = mysqli_fetch_assoc($result1); 
            

            $sql = "SELECT * FROM `customer` WHERE `sno`= $to";
            $result2= mysqli_query($con,$sql);
            $row2 = mysqli_fetch_assoc($result2);



            // constraint to check input of negative value by user
            if (($amount)<0)
            {
                echo '<script type="text/javascript">';
                echo ' alert("Enter a valid amount")';  // showing an alert box.
                echo '</script>';
            }


        
            // constraint to check insufficient balance.
            else if($amount > $row1['balance']) 
            {
                
                echo '<script type="text/javascript">';
                echo ' alert("Insufficient Balance")';  // showing an alert box.
                echo '</script>';
            }
            


            // constraint to check zero values
            else if($amount == 0){

                echo "<script type='text/javascript'>";
                echo "alert('Enter a valid amount')";
                echo "</script>";
            }


            else {
                
                // deducting amount from sender's account
                $newbalance = $row1['balance'] - $amount;
                $sql = "UPDATE `customer` SET `balance`= $newbalance WHERE `sno`= $from";
                mysqli_query($con,$sql);
            

                // adding amount to reciever's account
                $newbalance = $row2['balance'] + $amount;
                $sql = "UPDATE `customer` SET `balance`=$newbalance WHERE `sno`= $to";
                mysqli_query($con,$sql);
                
                $sender = $row1['name'];
                $receiver = $row2['name'];
                $sql = "INSERT INTO `transaction`(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $result=mysqli_query($con,$sql);

                if($result){
                    $showAlert = "Transaction Successful";
                    
                    header("location:transactionhistory.php?alert=$showAlert");
                }

                $newbalance= 0;
                $amount =0;
                }
            
        }
?>


  <!doctype html>
  <html lang="en">

  <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

      <title>TSFB</title>
      <link rel="stylesheet" href="styling.css">
  </head>

  <body>
    <div class="main" style="background: linear-gradient(to left,#91b3fa,white); overflow: scroll;">
       <nav>
            <div class="logo" style="margin-bottom: 17px;">
                <h1><a href="http://localhost/SampleDB/Banking.html">TSFB</h1>
            </div>
            <div class="nav-links" style="margin-bottom: 17px; margin-right: 2px;">
                <ul>
                    <li style="color: #fff; text-decoration: none;"><a href="http://localhost/SampleDB/Banking.html"></a>Home</li>
                    <li style="font-size: 16px;"><a href="http://localhost/SampleDB/customer.php">Customers</a></li>
                    <li style="font-size: 16px;"><a href="http://localhost/SampleDB/transactionhistory.php">Transaction History</a></li>
                    <li style="font-size: 16px;"><a href="#">About Us</a></li>
                </ul>
            </div>
       </nav> 
      <?php  
      require'dbconfig/config.php';
    ?>




      <!-- For displaying a particular user starts here -->
      <div class="flex-column--space-between">
          <div class="container">
              <div class="outer_container">
                  <center> <h1 class="text-center my-5" style="border-radius: 20px;
                                                background :white;
                                                border: 3px solid #f1f1f1;
                                                width: 1010px;
                                                height: 70px;
                                                margin: 0 auto;
                                                margin-top: 0px;">Transaction</h1></center>
              </div>
              <div class="main-wrapper" style="border-radius: 20px;
                                    background: white;
                                    border: 3px solid #f1f1f1;
                                    width: 1013px; 
                                    margin: 0 auto;">
              <?php
               
                $sno=$_GET['id'];
                $sql = "SELECT * FROM  customer where `sno`='$sno'";
                $result = mysqli_query($con,$sql);
                $rows = mysqli_fetch_assoc($result);
               
            ?>

              <form method="post">
                <div class="inner_container" style="background-color:white;
                                                    width: 990px;
                                                    margin: 10px auto;">
                  <table class="table table-striped">
                      <tr>
                          <th scope="col">Account No.</th>
                          <th scope="col">Account Holder</th>
                          <th scope="col">Account Balance(in Rs.)</th>
                      </tr>
                      <?php
                    echo '<tr>
                            <th scope="row"> '.$rows['acc_no'].'</td>
                            <td>'. $rows['name'] .'</td>
                            <td>'. $rows['balance'] .'</td>
                        </tr>';
                ?>
                  </table>

                  <!-- For displaying a particular user ends here -->



                  <div class="mt-5">
                      <label for="Transfer_to" class="form-label">Transfer To</label>
                      <select name="to" class="form-select" aria-label="Default select example">
                          <option selected>Choose Account</option>


                  <?php
                    $sid=$_GET['id'];
                    $sql = "SELECT * FROM customer where `sno`!=$sid ";
                    $result=mysqli_query($con,$sql);
                    
                    while($row = mysqli_fetch_assoc($result)) {
                    echo '<option  value="'. $row['sno'].'">'.$row['name'].'</option>';
                    }    
                  ?>
                      </select>
                  </div>

                  <div class="mt-3">
                      <label for="amount" class="form-label">Amount</label>
                      <input type="text" class="form-control " id="amount" name="amount" placeholder="Enter amount">

                      <button type="submit" class="btn btn-success px-5 my-3">Transfer</button>
                  </div>
              </form>
          
      <script src="index.js"></script>
    </div>
      </div>
    </div>
  </div>
</div>
  </body>

  </html>