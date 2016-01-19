<?php echo $header; ?>
  <?php echo $column_left; ?>
    <div id="content">
      <div class="page-header">
        <div class="container-fluid">
          <div class="pull-right">
            <button type="submit" form="form-authorizenet-sim" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
            <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
          <h1>
            <?php echo $heading_title; ?>
          </h1>
          <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
              <li>
                <a href="<?php echo $breadcrumb['href']; ?>">
                  <?php echo $breadcrumb['text']; ?>
                </a>
              </li>
              <?php } ?>
          </ul>
        </div>
      </div>


      <div class="container-fluid">
        <?php if ($error_warning) { ?>
          <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>
            <?php echo $error_warning; ?>
              <button type="button" class="close" data-dismiss="alert">&times;</button>
          </div>
          <?php } ?>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i>
                  <?php echo $text_edit; ?>
                </h3>
              </div>
              <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-authorizenet-sim" class="form-horizontal">


                  <div class="form-group required">

                    <div class="col-sm-10">
                      GetFinancing is an online Purchase Finance Gateway. Choose GetFinancing as your payment gateway to get access to multiple lenders in a powerful platform.
                    </div>
                    <div class="col-sm-10">&nbsp;</div>
                    <div class="col-sm-10">

                      <?php if (empty ($getfinancing_merchant_id)) { ?>
                      <button class="btn btn-primary" type="button" onclick="window.open('https://www.getfinancing.com/signup')">Sign up for GetFinancing</button>

                      <?php }else{ ?>

                      <button class="btn btn-primary" type="button" onclick="window.open('https://partner.getfinancing.com/partner/portal')">Login for your GetFinancing Account</button>

                      <?php } ?>

                      <button class="btn btn-primary" type="button" onclick="window.open('https://www.getfinancing.com/')">Learn more</button>

                      </div>
                  </div>





                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-merchant">
                      <?php echo $merchant_id; ?>
                    </label>
                    <div class="col-sm-10">
                      <input type="text" name="getfinancing_merchant_id" value="<?php echo $getfinancing_merchant_id; ?>" placeholder="<?php echo $merchant_id; ?>" id="merchant_id" class="form-control" />
                      <?php if ($error_merchant_id) { ?>
                        <div class="text-danger">
                          <?php echo $error_merchant_id; ?>
                        </div>
                        <?php } ?>
                    </div>
                  </div>

                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-merchant">
                      <?php echo $username; ?>
                    </label>
                    <div class="col-sm-10">
                      <input type="text" name="getfinancing_username" value="<?php echo $getfinancing_username; ?>" placeholder="<?php echo $username; ?>" id="username" class="form-control" />
                      <?php if ($error_username) { ?>
                        <div class="text-danger">
                          <?php echo $error_username; ?>
                        </div>
                        <?php } ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-merchant">
                      <?php echo $password; ?>
                    </label>
                    <div class="col-sm-10">
                      <input type="text" name="getfinancing_password" value="<?php echo $getfinancing_password; ?>" placeholder="<?php echo $password; ?>" id="password" class="form-control" />
                      <?php if ($error_password) { ?>
                        <div class="text-danger">
                          <?php echo $error_password; ?>
                        </div>
                        <?php } ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">
                      <?php echo $entry_test; ?>
                    </label>
                    <div class="col-sm-10">
                      <label class="radio-inline">
                        <?php if ($getfinancing_test) { ?>
                          <input type="radio" name="getfinancing_test" value="1" checked="checked" />
                          <?php echo $text_yes; ?>
                            <?php } else { ?>
                              <input type="radio" name="getfinancing_test" value="1" />
                              <?php echo $text_yes; ?>
                                <?php } ?>
                      </label>
                      <label class="radio-inline">
                        <?php if (!$getfinancing_test) { ?>
                          <input type="radio" name="getfinancing_test" value="0" checked="checked" />
                          <?php echo $text_no; ?>
                            <?php } else { ?>
                              <input type="radio" name="getfinancing_test" value="0" />
                              <?php echo $text_no; ?>
                                <?php } ?>
                      </label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-status">
                      <?php echo $entry_status; ?>
                    </label>
                    <div class="col-sm-10">
                      <select name="getfinancing_status" id="input-status" class="form-control">
                        <?php if ($getfinancing_status) { ?>
                          <option value="1" selected="selected">
                            <?php echo $text_enabled; ?>
                          </option>
                          <option value="0">
                            <?php echo $text_disabled; ?>
                          </option>
                          <?php } else { ?>
                            <option value="1">
                              <?php echo $text_enabled; ?>
                            </option>
                            <option value="0" selected="selected">
                              <?php echo $text_disabled; ?>
                            </option>
                            <?php } ?>
                      </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-sort-order">
                      <?php echo $entry_sort_order; ?>
                    </label>
                    <div class="col-sm-10">
                      <input type="text" name="getfinancing_sort_order" value="<?php echo $getfinancing_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
                    </div>
                  </div>


                </form>
              </div>
            </div>
      </div>
    </div>
    <?php echo $footer; ?>
