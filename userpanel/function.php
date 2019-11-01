<?php
function component($productname, $productPrice, $productImage, $product_id)
{
    $element = "
     <div class=\"col-md-4 my-3 my-md-0 p-3\">
      <form action=\"AdvCart.php\" method=\"post\" enctype=\"multipart/form-data\" >
        <div class=\"card shadow bg-white\">
                    <div>
                   <img src=\"../admin/$productImage\" class=\"img-fluid card-img-top\" alt=\"$productname\" style=\"height:254px\">
                    </div>
                    <div class=\"card-body\">
                        <h4 class=\"card-title\">$productname</h4>
                        <h6>
                            <i class=\"fa fa-star\"></i>
                            <i class=\"fa fa-star\"></i>
                            <i class=\"fa fa-star\"></i>
                            <i class=\"fa fa-star\"></i>
                            <i class=\"fa fa-star\"></i>
                        </h6>
                        <p class=\"card-text\">
                            Some Thing Went going wrong Please .
                        </p>
                        <h5 class=\"price\"> Rs $productPrice /-</h5>
                        <button type=\"submit\" name=\"add\" class=\"btn btn-warning my-3\">Add to Cart <span class=\"fa fa-shopping-cart\"></span> </button>
                        <input type='hidden' name='productid' value='$product_id' />
                    </div>
               </div>
               </form>
        </div>
   ";
    echo $element;
}

function cartProduct($productimg, $productname, $productprice, $id)
{
    $cartElement = "
     <form action=\"cartphp.php?action=delete&id=$id\" method=\"post\" enctype=\"multipart/form-data\" id='cart-item'>
                                 <div class=\"border rounded \" >
                                     <div class=\"row bg-white p-3\" >
                                         <div class=\"col-md-3 pl-0\">
                                             <img src=\"../admin/$productimg\" style=\"width: 100%;height: 185px\" alt=\"\">
                                         </div>
                                         <div class=\"col-md-6\">
                                             <h4 class=\"pt-2\">$productname</h4>
                                             <small class=\"text-\">Daily Tuition</small>
                                             <h5 class='pt-2'>Rs $productprice /-</h5>
                                             <button type=\"submit\" class=\"btn btn-warning\">Save for Later</button>
                                             <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"delete\">Remove</button>
                                         </div>
                                         <div class=\"col-md-3\">
                                             <div class=\"py-5\">
                                                 <button type=\"button\" class=\"btn bg-light rounded-circle\"> <i class=\"fa fa-minus\"></i> </button>
                                                 <input type=\"text\" name=\"qty\" value=\"1\" id=\"\" class=\"form-control w-25 d-inline\" />
                                                 <button type=\"button\" class=\"btn bg-light rounded-circle\"> <i class=\"fa fa-plus\"></i> </button>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 
                             </form>
    ";
    echo $cartElement;
}

