<?php 
$con = mysqli_connect('localhost','root','','smrusqsn_store');
require("PHPExcel/Classes/Excel.php");
require("vendor/autoload.php");



if(isset($_POST['submit'])){
    $tabName = $_POST['tabName'];
    $format = $_POST['format'];
    // echo $tabName;
    if($format === 'PDF'){


        if($tabName === 'Brands'){
            $q = "select * from brands";
            $result = mysqli_query($con,$q);

            if(mysqli_num_rows($result)>0){

                $html = "<table>";
                $html .= "<tr><td>Brand ID</td><td>Brand Name</td><td>Brand Active</td><td>Brand Status</td></tr>";
                while($row = mysqli_fetch_assoc($result)){
                    $html .= "<tr><td>".$row['brand_id']."</td><td>".$row['brand_name']."</td><td>".$row['brand_active']."</td><td>".$row['brand_status']."</td></tr>";
                }
                $html .= "</table>";
            }
        }else if($tabName === 'Categories'){
            $q = "select * from categories";
            $result = mysqli_query($con,$q);

            if(mysqli_num_rows($result)>0){

                $html = "<table>";
                $html .= "<tr><td>Categories ID</td><td>Categories Name</td><td>Categories Active</td><td>Categories Status</td></tr>";
                while($row = mysqli_fetch_assoc($result)){
                    $html .= "<tr><td>".$row['categories_id']."</td><td>".$row['categories_name']."</td><td>".$row['categories_active']."</td><td>".$row['categories_status']."</td></tr>";
                }
                $html .= "</table>";
            }

        }else if($tabName === 'Orders'){
            $q = "select * from orders";
            $result = mysqli_query($con,$q);

            if(mysqli_num_rows($result)>0){

                $html = "<table class='table table-striped table-bordered'>";
                $html .= "<tr><td>Order ID</td><td>Order Date</td><td>Client Name</td><td>Client Contact</td>
                <td>Sub Total</td><td>VAT</td><td>Total Amount</td><td>Discount</td><td>Grand Total</td>
                <td>Paid</td><td>Due</td><td>Payment Type</td><td>Payment Status</td><td>Payment Place</td>
                <td>GSTN</td>Order Status<td></td><td>User ID</td></tr>";
                while($row = mysqli_fetch_assoc($result)){
                    $html .= "<tr><td>".$row['order_id']."</td><td>".$row['order_date']."</td><td>".$row['client_name']."</td><td>".$row['client_contact']."</td><td>".$row['sub_total']."</td><td>".$row['vat'].
                    "</td><td>".$row['total_amount']."</td><td>".$row['discount']."</td><td>".$row['grand_total']."</td>
                    <td>".$row['paid']."</td><td>".$row['due']."</td><td>".$row['payment_type'].
                    "</td><td>".$row['payment_status']."</td><td>".$row['payment_place']."</td>
                    <td>".$row['gstn']."</td><td>".$row['order_status']."</td><td>".$row['user_id']."</td><td></tr>";
                }
                $html .= "</table>";
            }
        
        }else if($tabName === 'Order Item'){
            $q = "select * from order_item";
            $result = mysqli_query($con,$q);

            if(mysqli_num_rows($result)>0){

                $html = "<table>";
                $html .= "<tr><td>Order Item ID</td><td>Order ID</td><td>Product ID</td><td>Quantity</td>
                    <td>Rate</td><td>Total</td><td>Order Item Status</td><td>Product Wise Discount</td><td>Product Wise Discount Amount</td>
                </tr>";
                while($row = mysqli_fetch_assoc($result)){
                    $html .= "<tr><td>".$row['order_item_id']."</td><td>".$row['order_id']."</td><td>".$row['product_id'].
                    "</td><td>".$row['quantity']."</td>
                    <td>".$row['rate']."</td><td>".$row['total']."</td><td>".$row['order_item_status']."</td><td>".$row['product_wise_discount']."</td>
                    <td>".$row['product_wise_discount_amount']."</td>
                    
                    
                    </tr>";
                }
                $html .= "</table>";
            }
        }else if($tabName === 'Product'){
            $q = "select * from product";
            $result = mysqli_query($con,$q);

            if(mysqli_num_rows($result)>0){

                $html = "<table>";
                $html .= "<tr><td>Product ID</td><td>Product Name</td><td>Product Image</td><td>Brand ID</td>
                <td>Categories ID</td><td>Quantity</td><td>Rate</td><td>Active</td><td>Status</td><td>Cost Price </td>
                
                </tr>";
                while($row = mysqli_fetch_assoc($result)){
                    $html .= "<tr><td>".$row['product_id']."</td><td>".$row['product_name']."</td><td>"
                    .$row['product_image']."</td><td>".$row['brand_id']."</td>
                    <td>".$row['categories_id']."</td><td>".$row['quantity']."</td><td>".$row['rate'].
                    "</td><td>".$row['active']."</td><td>".$row['status']."</td>
                    <td>".$row['cost_price']."</td>
                    </tr>";
                }
                $html .= "</table>";
            }
        }else if($tabName === 'Users'){
            $q = "select * from users";
            $result = mysqli_query($con,$q);

            if(mysqli_num_rows($result)>0){

                $html = "<table>";
                $html .= "<tr><td>User ID</td><td>Username</td><td>Password</td><td>Email</td></tr>";
                while($row = mysqli_fetch_assoc($result)){
                    $html .= "<tr><td>".$row['user_id']."</td><td>".$row['username']."</td><td>".$row['password']."</td><td>".$row['email']."</td></tr>";
                }
                $html .= "</table>";
            }
        }else{
            echo "Pls select a table";
        }

        $mpdf = new \Mpdf\Mpdf();
        $mpdf -> WriteHTML($html);
        $file = time().'.pdf';
        $mpdf -> output($file,'D');



    }else if($format === 'Excel'){

        if($tabName === 'Brands'){
            $q = "select * from brands";
            $result = mysqli_query($con,$q);
            if(mysqli_num_rows($result)>0){
                $i=0;
                while($row = mysqli_fetch_assoc($result)){
                    $data[$i]['Brand ID'] = $row['brand_id']; 
                    $data[$i]['Brand Name'] = $row['brand_name']; 
                    $data[$i]['Brand Active'] = $row['brand_active']; 
                    $data[$i]['Brand Status'] = $row['brand_status'];
                    $i++; 
                }
            }
        }else if($tabName === 'Categories'){
            $q = "select * from categories";
            $result = mysqli_query($con,$q);
            if(mysqli_num_rows($result)>0){
                $i=0;
                while($row = mysqli_fetch_assoc($result)){
                    $data[$i]['Categories ID'] = $row['categories_id']; 
                    $data[$i]['Categories Name'] = $row['categories_name']; 
                    $data[$i]['Categories Active'] = $row['categories_active']; 
                    $data[$i]['Categories Status'] = $row['categories_status'];
                    $i++; 
                }
            }
        }else if($tabName === 'Orders'){
            $q = "select * from orders";
            $result = mysqli_query($con,$q);
            if(mysqli_num_rows($result)>0){
                $i=0;
                while($row = mysqli_fetch_assoc($result)){
                    $data[$i]['Order ID'] = $row['order_id']; 
                    $data[$i]['Order Date'] = $row['order_date']; 
                    $data[$i]['Client Name'] = $row['client_name']; 
                    $data[$i]['Client Contact'] = $row['client_contact'];
                    $data[$i]['Sub Total'] = $row['sub_total'];
                    $data[$i]['VAT'] = $row['vat'];
                    $data[$i]['Total Amount'] = $row['total_amount'];
                    $data[$i]['Discount'] = $row['discount'];
                    $data[$i]['Grand Total'] = $row['grand_total'];
                    $data[$i]['Paid'] = $row['paid'];
                    $data[$i]['Due'] = $row['due'];
                    $data[$i]['Payment Type'] = $row['payment_type'];
                    $data[$i]['Payment Status'] = $row['payment_status'];
                    $data[$i]['Payment Place'] = $row['payment_place'];
                    $data[$i]['GSTN'] = $row['gstn'];
                    $data[$i]['Order Status'] = $row['order_status'];
                    $data[$i]['User ID'] = $row['user_id'];
                    $i++; 
                }
            }
        }else if($tabName === 'Order Item'){
            $q = "select * from order_item";
            $result = mysqli_query($con,$q);
            if(mysqli_num_rows($result)>0){
                $i=0;
                while($row = mysqli_fetch_assoc($result)){
                    $data[$i]['Order Item ID'] = $row['order_item_id']; 
                    $data[$i]['Order ID'] = $row['order_id']; 
                    $data[$i]['Product ID'] = $row['product_id']; 
                    $data[$i]['Quantity'] = $row['quantity']; 
                    $data[$i]['Rate'] = $row['rate'];
                    $data[$i]['Total'] = $row['total'];
                    $data[$i]['Order Item Status'] = $row['order_item_status'];
                    $data[$i]['Product Wise Discount'] = $row['product_wise_discount'];
                    $data[$i]['Product Wise Discount Amount'] = $row['product_wise_discount_amount'];
                    $i++; 
                }
            }
        }else if($tabName === 'Product'){
            $q = "select * from product";
            $result = mysqli_query($con,$q);
            if(mysqli_num_rows($result)>0){
                $i=0;
                while($row = mysqli_fetch_assoc($result)){
                    $data[$i]['Product ID'] = $row['product_id']; 
                    $data[$i]['Product Name'] = $row['product_name']; 
                    $data[$i]['Product Image'] = $row['product_image']; 
                    $data[$i]['Brand ID'] = $row['brand_id'];
                    $data[$i]['Categories ID'] = $row['categories_id'];
                    $data[$i]['Quantity'] = $row['quantity'];
                    $data[$i]['Rate'] = $row['rate'];
                    $data[$i]['Active'] = $row['active'];
                    $data[$i]['Status'] = $row['status'];
                    $data[$i]['Cost Price'] = $row['cost_price'];
                    $i++; 
                }
            }
        }else if($tabName === 'Users'){
            $q = "select * from users";
            $result = mysqli_query($con,$q);
            if(mysqli_num_rows($result)>0){
                $i=0;
                while($row = mysqli_fetch_assoc($result)){
                    $data[$i]['User ID'] = $row['user_id']; 
                    $data[$i]['Username'] = $row['username']; 
                    $data[$i]['Password'] = $row['password']; 
                    $data[$i]['Email'] = $row['email'];
                    $i++; 
                }
        }else{
            echo "Enter a table";
        }
    
        }
        $excel = new excel();
        $filename = date('d-m-y').'.xls';
        $excel->userDefinedstream($filename,$data);
    }else{
        echo "<h1>Please Select a Format!</h1>";
    }



}



?>