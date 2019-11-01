<?php
session_start();
?>
<h2>Please Transfer Your Chase Through Paypal redirect to Site</h2>
<?php
 $paypal_url='https://www.sandbox.paypal.com/';
 $pay=$_SESSION['pay'];
 $checkout_Id= $_SESSION['checkout_Id'];
 
 

 ?>
<form action="<?php echo $paypal_url;?>/cgi-bin/webscr" method="post" name="buyCredit" id="buyCredit">

    <input type="hidden" name="cmd" value="_xclick" />
    <input type="hidden" name="business" value="usmanhaiderkhan4@gmail.com" />
    <input type="hidden" name="currency_code" value="USD" />
    <input type="hidden" name="item_name" value="payment for testing" />
    <input type="hidden" name="item_number" value="1212" />
    <input type="hidden" name="amount" value="<?php echo $pay;?>" />
    <input type="hidden" name="return" value="http://localhost:70/shopingSite/userpanel/payment_success.php?id=<?php echo $checkout_Id;?>">

</form>
<script type="text/javascript">
    document.getElementById("buyCredit").submit();
</script>
