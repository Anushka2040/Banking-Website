<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>TSFB</title>
    <link rel="stylesheet" href="styling.css">
</head>

<body>
    <div class="main" style="overflow: scroll;
                             background: linear-gradient(to left,#91b3fa,white);">
       <nav>
            <div class="logo"  style="margin-bottom: 10px;
                                      font-color: #fea6a4">
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
     <div class="outer_container">
           <center> <h1 class="text-center my-5" style="border-radius: 20px;
                                                background :white;
                                                border: 3px solid #f1f1f1;
                                                width: 1000px;
                                                height: 70px;
                                                margin: 0 auto;">Our Customers</h1></center>
    </div>
    <div class="main-wrapper" style="border-radius: 20px;
                                    background: white;
                                    border: 3px solid #f1f1f1;
                                    width: 1013px; 
                                    margin: 0 auto;">
    <div class="flex-column--space-between">
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Account no</th>
                        <th scope="col">Account Holder</th>
                        <th scope="col">Balance</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                    <?php            
                $sql= "SELECT * FROM customer";
                @$result = mysqli_query($con,$sql);
                while($row=mysqli_fetch_assoc($result)){
                    @$sno=$row['sno'];
                   
                    echo '<tr>
                            <th scope="row">'.$row['acc_no'].'</th>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['balance'].'</td>
                            <td class="text-center" style="cursor:pointer"> <a href="transaction.php?id='.$sno.'" style="text-decoration:none;color:black;">
                            <button type="submit" class="btn btn-success px-5 my-3">Transfer</button>
                            </td>
                           
                        </tr>';
          
                }
            ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</div>  
</body>

</html>