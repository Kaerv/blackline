<?php

class Blackline_CreatorAddtocartModuleFrontController extends ModuleFrontController {

    public function initContent() {
      parent::initContent();
    }

    public function postProcess() {
        $data = $_POST;
        if(!$this->context->cart->id) {

            if($this->context->cookie->id_guest) {
                $guest = new Guest($this->context->cookie->id_guest);
                $this->context->cart->mobile_theme = $guest->mobile_theme;
            }
            $this->context->cart->add();
        
            if($this->context->cart->id) {
                $this->context->cookie->id_cart = (int)$this->context->cart->id;
            }
        }
        $cart = $this->context->cart;
        $id_customization = 0;
        $product = new Product($data["id_product"], true, (int)($this->context->cookie->id_lang));
        $id_product_attribute = Product::getDefaultAttribute($data["id_product"]);
        $cart->updateQty(1, $data["id_product"], $id_product_attribute, $id_customization);

        $img = $data["img"];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);

        $file = date("Y-m-d-H-i-s").''.$this->generateRandomString();
        $fileName = $_SERVER["DOCUMENT_ROOT"]."/creator/$file.png";
        file_put_contents($fileName, $fileData);
        print($fileName);
    }

    public function setMedia() {
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}