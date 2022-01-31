<?php include ("../header.php"); ?>

    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                    <?php 
                        $subtotal=0;
                        $CusID = $_SESSION['CusID'];
                        $cartItem = getSubData('cart', 'CusID', $CusID);
                        foreach ($cartItem as $item1){
                        $id = $item1['ProdID'];
                        $Quantity=$item1['Quantity'];
                        $product = getSubData('product', 'ProdID', $id);
                        foreach ($product as $item) { ?>
                        <tr>
                            <td class="align-middle"> <a href="detail.php? id=<?php echo $id ?>" class= "nav-link" > <img src="<?php echo $item['ProdImageLink']?>" alt="" style="width: 50px;"> <?php echo $item['ProdName']?> </a> </td>
                            <td class="align-middle"> $ <?php echo $item['ProdPrice']?> </td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 80px;">
                                    
                                    <input type="text" class="form-control form-control-sm bg-secondary text-center" value="<?php echo $item1['Quantity'] ?>">
                                    
                                </div>
                            </td>
                            <?php $total=$item['ProdPrice']*$Quantity;?>
                            <td class="align-middle"> $ <?php echo $total ?> </td>
                            <td class="align-middle">
                                <?php
                                    if(isset($_POST['cart'])) {
                                        $CusID = $_SESSION['CusID'];
                                        removeFromCart($CusID, $id);
                                        //header("refresh: 3");
                                    }
                                ?>
                                <form method="post">
                                    <button type="submit" name="cart" value="cart" 
                                    class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php 
                    $subtotal+=$total;
                    }} // closing foreach function ?>

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">$ <?php echo $subtotal ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">$ <?php echo $subtotal+10 ?></h5>
                        </div>

                        <form action="checkout.php" method="post">
                            <button type="submit" name="cart" value="cart" 
                            class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

<?php include ("../footer.php"); ?>