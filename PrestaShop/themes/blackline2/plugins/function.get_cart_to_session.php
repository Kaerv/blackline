<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.get_cart_to_session.php
 * Type:     function
 * Name:     get_cart_to_session
 * Purpose:  Send cart variables to session variable
 * -------------------------------------------------------------
 */
function smarty_function_get_cart_to_session($params, $smarty)
{
    $_SESSION["cart"] = $params['cart'];
    $_SESSION["productImg"] = $params['productImg'];
    $_SESSION["productName"] = $params['productName'];
    $_SESSION["productPrice"] = $params['productPrice'];
    $_SESSION["productQuantity"] = $params['productQuantity'];

    $_SESSION["cartLink"] = $params['cartLink'];
    $_SESSION["summaryLink"] = $params['summaryLink'];
}
?>