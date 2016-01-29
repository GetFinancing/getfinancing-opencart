<?php

class ControllerPaymentGetfinancing extends Controller
{
    private $error;

    public function index()
    {
        //v2.0
        //$this->load->language('payment/getfinancing');
        //v1.5
        $this->language->load('payment/getfinancing');

        $this->data['text_testmode'] = $this->language->get('text_testmode');
        // Set up confirm/back button text
        $this->data['button_confirm'] = $this->language->get('button_confirm');
        $this->data['button_back'] = $this->language->get('button_back');

        // Load model for checkout page
        $this->load->model('checkout/order');

        // Load order into memory
        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

				//populate data to invoke form
        $this->data['full_name'] = $order_info['payment_firstname'].' '.$order_info['payment_lastname'];
        $this->data['first_name'] = $order_info['payment_firstname'];
        $this->data['last_name'] = $order_info['payment_lastname'];

        $currency = $order_info['currency_code'];
        $this->data['currency_code'] = $order_info['currency_code'];

        $this->data['phone'] = $order_info['telephone'];
        $this->data['amount'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false) * 100;
        $this->data['total'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false) * 100;


                // Other params for payment page
                $this->data['email'] = $order_info['email'];

                // Encrypt order id for verification
                //$this->load->library('encryption');

                //$encryption = new Encryption($this->config->get('config_encryption'));
                //$enc = $encryption->encrypt($this->session->data['order_id']);
                //for security reasons we encrypt the order id
                $this->data['order_id'] = $this->session->data['order_id'];
                //encrypted version
                //$this->data['order_id'] =$enc;
                $route = $_GET['route'];

                // Set success/fail urls
                $this->data['redirector_success'] = HTTPS_SERVER.'index.php?route=payment/getfinancing/success&';
                //$this->data['redirector_success'] = urlencode($enc);
                $this->data['redirector_failure'] = HTTPS_SERVER.'index.php?route=payment/getfinancing/failure&';

                //adresss

                $this->data['street'] = $order_info['payment_address_1'].' '.$order_info['payment_address_2'];
        $this->data['city'] = $order_info['payment_city'];
        $this->data['province'] = $order_info['payment_zone'];
        $this->data['citycode'] = $order_info['payment_postcode'];

        $shipping_amount=0;
        if (isset($this->session->data['shipping_method'])){
          $shipping = $this->session->data['shipping_method'];

          if (!empty($shipping)) {
              $shipping_amount = number_format($shipping['cost'],2,'','.');
          }
        }

          //taxes
          	$taxes = $this->cart->getTaxes();
            $tax_price=0;
            foreach ($taxes as $t => $price){
                $tax_price+=$price;
            }


                //product description
                $products = $this->cart->getProducts();
                $description="";
        foreach ($products as $key => $item) {
            $description[]=$item['name'] . " ( ".$item['quantity'].") ";
        }
        $this->data['description']=implode(",",$description);

        $merchant_loan_id = md5(time() . $this->config->get('getfinancing_merchant_id') . $order_info['payment_firstname'] . $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false));
        //hack - if guest account, overwrite shipping info
        if (empty($order_info['shipping_address_1'])){$order_info['shipping_address_1']= $order_info['payment_address_1'].' '.$order_info['payment_address_2'];}
        if (empty($order_info['shipping_city'])){$order_info['shipping_city']= $order_info['payment_city'];}
        if (empty($order_info['shipping_zone'])){$order_info['shipping_zone']= $order_info['payment_zone'];}
        if (empty($order_info['shipping_postcode'])){$order_info['shipping_postcode']= $order_info['payment_postcode'];}

        $getfinancing_data = array(
            'amount'           =>  $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false),
            'product_info'     =>  $this->data['description'],
            'first_name'       => $order_info['payment_firstname'],
            'last_name'        => $order_info['payment_lastname'],
            'shipping_address' => array(
                'street1'  => $order_info['payment_address_1'].' '.$order_info['payment_address_2'],
                'city'    => $order_info['payment_city'],
                'state'   => $order_info['payment_zone'],
                'zipcode' => $order_info['payment_postcode']
            ),
            'billing_address' => array(
                'street1'  => $order_info['shipping_address_1'],
                'city'    => $order_info['shipping_city'],
                'state'   => $order_info['shipping_zone'],
                'zipcode' => $order_info['shipping_postcode']
            ),
            'email'            => $order_info['email'],
            'merchant_loan_id' => (string)$this->session->data['order_id'],
            'shipping_amount'  => $shipping_amount,
            'version' => '1.9'
        );

        $body_json_data = json_encode($getfinancing_data);
        $header_auth = base64_encode($this->config->get('getfinancing_username') . ":" . $this->config->get('getfinancing_password'));

        if ($this->config->get('getfinancing_test')) {
            $url_to_post = "https://api-test.getfinancing.com";
        } else {
            $url_to_post = "https://api.getfinancing.com";
        }

        $url_to_post = $url_to_post.'/merchant/' . $this->config->get('getfinancing_merchant_id')  . '/requests';

        $post_args = array(
            'body' => $body_json_data,
            'timeout' => 60,     // 60 seconds
            'blocking' => true,  // Forces PHP wait until get a response
            'sslverify' => false,
            'headers' => array(
              'Content-Type' => 'application/json',
              'Authorization' => 'Basic ' . $header_auth,
              'Accept' => 'application/json'
             )
        );

        $ch = curl_init($url_to_post);

        curl_setopt($ch, CURLOPT_URL, $url_to_post);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_POST, 1);
        $array_headers = array();
         foreach ($post_args['headers'] as $k => $v) {
             $array_headers[] = $k . ": " . $v;
         }
         if (sizeof($array_headers)>0) {
           curl_setopt($ch, CURLOPT_HTTPHEADER, $array_headers);
         }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_args['body']);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION ,1);
        // FIXME: we have to set response_format
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //    "Accept: application/xml"
        //));
//        curl_setopt($ch, CURLOPT_HEADER, 0); // DO NOT RETURN HTTP HEADERS
        /* return contents of the call as a variable; otherwise it prints */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

        $result = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        $res = json_decode($result,true);
        if( !empty($res['type'])){
          //TODO: show error
          $this->document->setTitle($this->language->get('heading_fail'));
          $this->session->data['error'] = $this->language->get('heading_fail');
          $this->response->redirect($this->url->link('checkout/checkout', '', 'SSL'));
        }


        //form url
        $this->data['action'] = $res['href'];
        $this->data['inv_id'] = $res['inv_id'];
        // Render page template
        $this->id = 'payment';
        //version 2.0
        /*
        $this->data['header'] = $this->load->controller('common/header');
        $this->data['column_left'] = $this->load->controller('common/column_left');
        $this->data['footer'] = $this->load->controller('common/footer');

        if (file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/payment/getfinancing.tpl')) {
            return $this->load->view($this->config->get('config_template').'/template/payment/getfinancing.tpl', $data);
        } else {
            return $this->load->view('default/template/payment/getfinancing.tpl', $data);
        }
        */

        //version 1.5
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/getfinancing.tpl')) {
    			$this->template = $this->config->get('config_template') . '/template/payment/getfinancing.tpl';
    		} else {
    			$this->template = 'default/template/payment/getfinancing.tpl';
    		}
        $this->document->addScript('//partner.getfinancing.com/libs/1.0/getfinancing.js');
        $this->render();

    }

    public function failure()
    {
        $this->language->load('payment/getfinancing');

        $this->document->setTitle($this->language->get('heading_fail'));
        $this->session->data['error'] = $this->language->get('heading_fail');
        $this->response->redirect($this->url->link('checkout/checkout', '', 'SSL'));

    }

    public function success()
    {
        $this->response->redirect(HTTPS_SERVER.'index.php?route=checkout/success');
    }



    public function callback()
    {

      $json = file_get_contents('php://input');
      $notification = json_decode($json, true);
      $order_id = "";
      $order_token = "";
      $gf_token = "";
      $new_state = "";

      if(isset($notification['merchant_transaction_id'])) {
          $order_id = (int) $notification['merchant_transaction_id'];
      } else {
          die( "GetFinancing callback: merchant_transaction_id not set" );
          return;
      }

      if($order_id <= 0 ){
          die( "GetFinancing callback: order_id < 0" );
          return;
      }
      $this->load->model('checkout/order');
      $order_info = $this->model_checkout_order->getOrder($order_id);

      $new_state = $notification['updates']['status'];
      $gf_token = $notification['request_token'];

        if ($new_state == "approved") {
              $this->model_checkout_order->confirm($order_id, $this->config->get('config_order_status_id'), 'Order ID: '.$gf_token,true);
                return;

        }

        if ($new_state == "rejected") {
              $this->model_checkout_order->update($order_id, 7, 'Getfinancing rejected to finance this order',true);
                return;
        }

        if ($new_state == "preapproved") {
                // Keep on hold by update with a message.
                $this->model_checkout_order->update($order_id, 1, 'GetFinancing Pre-approved this order, please wait',false);
                  return;
        }

        die( "GetFinancing callback end of script ");
    }
}
?>
<script type="text/javascript" src="https://partner.getfinancing.com/libs/1.0/getfinancing.js"></script>
