<?php

class ControllerPaymentGetfinancing extends controller
{
    /**
     * ControllerPaymentGetfinancing::index().
     *
     * default route for form load/update
     */
    public function index()
    {
        // Compatibility for 1.4.7
        if (empty($this->session->data['token'])) {
            $this->session->data['token'] = '';
        }

        // Load language file and settings model
        $this->load->language('payment/getfinancing');
        $this->load->model('setting/setting');

        // Set page title
        $this->document->setTitle($this->language->get('heading_title'));

        // Process settings if form submitted
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
            $this->load->model('setting/setting');
            $this->model_setting_setting->editSetting('getfinancing', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            //$this->redirect(HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token']);
            //v2.0
            $this->response->redirect($this->url->link('extension/payment', 'token='.$this->session->data['token'], 'SSL'));
        }

        // Load language texts
        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_all_zones'] = $this->language->get('text_all_zones');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_edit'] = $this->language->get('text_edit');
        $data['merchant_id'] = $this->language->get('merchant_id');
        $data['username'] = $this->language->get('username');
        $data['password'] = $this->language->get('password');
        $data['entry_test'] = $this->language->get('entry_test');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['entry_order_status'] = $this->language->get('entry_order_status');
        $data['tip'] = $this->language->get('tip');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['tab_general'] = $this->language->get('tab_general');

        // Set errors if fields not correct
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['merchant_id'])) {
            $data['error_merchant_id'] = $this->error['merchant_id'];
        } else {
            $data['error_merchant_id'] = '';
        }

        if (isset($this->error['username'])) {
            $data['error_username'] = $this->error['username'];
        } else {
            $data['error_username'] = '';
        }

        if (isset($this->error['password'])) {
            $data['error_password'] = $this->error['password'];
        } else {
            $data['error_password'] = '';
        }


        // Set breadcrumbs
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
               'href' => HTTPS_SERVER.'index.php?route=common/home&token='.$this->session->data['token'],
               'text' => $this->language->get('text_home'),
              'separator' => false,
        );

        $data['breadcrumbs'][] = array(
               'href' => HTTPS_SERVER.'index.php?route=extension/payment&token='.$this->session->data['token'],
               'text' => $this->language->get('text_payment'),
              'separator' => ' :: ',
        );

        $data['breadcrumbs'][] = array(
               'href' => HTTPS_SERVER.'index.php?route=payment/getfinancing&token='.$this->session->data['token'],
               'text' => $this->language->get('heading_title'),
              'separator' => ' :: ',
        );

        // Set save/cancel button urls
        $data['action'] = HTTPS_SERVER.'index.php?route=payment/getfinancing&token='.$this->session->data['token'];

        $data['cancel'] = HTTPS_SERVER.'index.php?route=extension/payment&token='.$this->session->data['token'];

        // Load values for fields
        if (isset($this->request->post['getfinancing_merchant_id'])) {
            $data['getfinancing_merchant_id'] = $this->request->post['getfinancing_merchant_id'];
        } else {
            $data['getfinancing_merchant_id'] = $this->config->get('getfinancing_merchant_id');
        }
        if (isset($this->request->post['getfinancing_username'])) {
            $data['getfinancing_username'] = $this->request->post['getfinancing_username'];
        } else {
            $data['getfinancing_username'] = $this->config->get('getfinancing_username');
        }
        if (isset($this->request->post['getfinancing_password'])) {
            $data['getfinancing_password'] = $this->request->post['getfinancing_password'];
        } else {
            $data['getfinancing_password'] = $this->config->get('getfinancing_password');
        }
        if (isset($this->request->post['getfinancing_test'])) {
            $data['getfinancing_test'] = $this->request->post['getfinancing_test'];
        } else {
            $data['getfinancing_test'] = $this->config->get('getfinancing_test');
        }
        if (isset($this->request->post['getfinancing_status'])) {
            $data['getfinancing_status'] = $this->request->post['getfinancing_status'];
        } else {
            $data['getfinancing_status'] = $this->config->get('getfinancing_status');
        }
        if (isset($this->request->post['getfinancing_sort_order'])) {
            $data['getfinancing_sort_order'] = $this->request->post['getfinancing_sort_order'];
        } else {
            $data['getfinancing_sort_order'] = $this->config->get('getfinancing_sort_order');
        }

        // Render template
        //v1.5.x version
        //$this->template = 'payment/getfinancing.tpl';
        //v2.0 version
        //v2.0
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('payment/getfinancing.tpl', $data));
    }

    /**
     * ControllerPaymentGetfinancing::validate().
     *
     * Validation code for form
     */
    private function validate()
    {
        if (!$this->user->hasPermission('modify', 'payment/getfinancing')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (empty($this->request->post['getfinancing_merchant_id'])) {
            $this->error['getfinancing_merchant_id'] = $this->language->get('error_getfinancing_merchant_id');
        }

        if (empty($this->request->post['getfinancing_username'])) {
            $this->error['getfinancing_username'] = $this->language->get('getfinancing_username');
        }

        if (empty($this->request->post['getfinancing_password'])) {
            $this->error['getfinancing_password'] = $this->language->get('getfinancing_password');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
}
