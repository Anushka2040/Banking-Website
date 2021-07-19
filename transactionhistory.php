<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    
    <link rel="stylesheet" href="styling.css">
</head>

<body>
    <div class="main" style="overflow: scroll;
                             background: linear-gradient(to left,#91b3fa,white);">
       <nav>
            <div class="logo" style="margin-bottom: 17px;">
                <h1><a href="http://localhost/SampleDB/Banking.html">TSFB</h1>
            </div>
            <div class="nav-links" style="margin-bottom: 17px; margin-right: 2px;">
                <ul>
                    <li style="font-size: 16px;"><a href="http://localhost/SampleDB/Banking.html">Home</a></li>
                    <li style="font-size: 16px;"><a href="http://localhost/SampleDB/customer.php">Customers</a></li>
                    <li style="font-size: 16px;"><a href="http://localhost/SampleDB/transactionhistory.php">Transaction History</a></li>
                    <li style="font-size: 16px;"><a href="#">About Us</a></li>
                </ul>
            </div>
       </nav> 

    <?php  
      require'dbconfig/config.php';
    ?>

    <?php
       if(isset($_GET['alert']) && $_GET['alert']!='false'){
        $showAlert=$_GET['alert'];
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>SUCCESS!</strong> '.$showAlert.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <div class="outer_container">
           <center> <h1 class="text-center my-5" style="border-radius: 20px;
                                                background :white;
                                                border: 3px solid #f1f1f1;
                                                width: 1000px;
                                                height: 70px;
                                                margin: 0 auto;">Transaction History</h1></center>
    </div>
    <div class="main-wrapper" style="border-radius: 20px;
                                    background: white;
                                    border: 3px solid #f1f1f1;
                                    width: 1013px; 
                                    margin-bottom: 20px;
                                    margin-left: 170px;">
    <div class="flex-column--space-between">
        <div class="inner_container" style="background: white;">
            <table class="table table-striped text-center ">
        
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>Sender</th>
                        <th>Receiver</th>
                        <th>Amount</th>
                        <th>Date&Time</th>
                    </tr>
                </thead>
                
            <tbody>

            <?php            
                $query= "select * from transaction";
                $query_run = mysqli_query($con,$query);
                while($row=mysqli_fetch_assoc($query_run))
                {
                    $sno=$row['sno'];
                    echo'<tr> 
                        <th scope="row">'.$row['sno'].'</th>
                        <td>'.$row['sender'].'</td>
                        <td>'.$row['receiver'].'</td>
                        <td>'.$row['balance'].'</td>
                        <td>'.$row['dt'].'</td>
                        </tr>';            
                }
            ?>
            </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
</body>

</html>