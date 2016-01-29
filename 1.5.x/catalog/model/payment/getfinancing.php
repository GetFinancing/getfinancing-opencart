<?php

class ModelPaymentGetfinancing extends Model
{
    public function getMethod($address,$total)
    {
        $this->load->language('payment/getfinancing');

        if ($this->config->get('getfinancing_status')) {
            $status = true;
        } else {
            $status = false;
        }

        $method_data = array();

        //original message
        $financia = $this->language->get('text_title');
        if ($status) {
            $method_data = array(
                'code' => 'getfinancing',
                  'title' => $financia,
            'terms' => $this->language->get('terms'),
                'sort_order' => $this->config->get('getfinancing_sort_order'),
              );
        }

        return $method_data;
    }

}
