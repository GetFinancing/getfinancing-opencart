<?php echo $header; ?>
<div id="content">
    <div class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
      <?php } ?>
    </div>

    <?php if ($error_warning) { ?>
   <div class="warning"><?php echo $error_warning; ?></div>
   <?php } ?>
   <div class="box">

     <div class="heading">
      <h1><img src="view/image/payment/logo_getfinancing.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a>
        <a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>

    <div class="content">
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                      <table class="form">
                        <tr>
<td colspan="10">
      GetFinancing is an online Purchase Finance Gateway. Choose GetFinancing as your payment gateway to get access to multiple lenders in a powerful platform.
    </td>


  </tr>
                  <tr>
                    <td colspan="10">
                    <div class="buttons">
                          <?php if (empty ($getfinancing_merchant_id)) { ?>
                    <a class="button" onclick="window.open('https://www.getfinancing.com/signup')">Sign up for GetFinancing</a>
                          <?php }else{ ?>
                    <a class="button" onclick="window.open('https://partner.getfinancing.com/partner/portal')">Login for your GetFinancing Account</a>
                        <?php } ?>
                    <a class="button" onclick="window.open('https://www.getfinancing.com/')">Learn more</a>
                  </div>
                </td>
                  </tr>



                      <tr>
                        <td> <?php echo $merchant_id; ?></td>
                        <td><input type="text" name="getfinancing_merchant_id" value="<?php echo $getfinancing_merchant_id; ?>"  id="merchant_id" placeholder="<?php echo $merchant_id; ?>"/>
                          <?php if ($error_merchant_id) { ?>
                          <span class="error"><?php echo $error_merchant_id; ?></span>
                          <?php } ?></td>
                      </tr>


                      <tr>
                        <td> <?php echo $username; ?></td>
                        <td><input type="text" name="getfinancing_username" value="<?php echo $getfinancing_username; ?>"  id="username" placeholder="<?php echo $username; ?>"/>
                          <?php if ($error_username) { ?>
                          <span class="error"><?php echo $error_username; ?></span>
                          <?php } ?></td>
                      </tr>


                      <tr>
                        <td> <?php echo $password; ?></td>
                        <td><input type="text" name="getfinancing_password" value="<?php echo $getfinancing_password; ?>"  id="password" placeholder="<?php echo $password; ?>"/>
                          <?php if ($error_password) { ?>
                          <span class="error"><?php echo $error_password; ?></span>
                          <?php } ?></td>
                      </tr>



                      <tr>
                         <td><span class="required">*</span> <?php echo $entry_test; ?></td>

                     <td>
                           <?php if ($getfinancing_test) { ?>
                       <input type="radio" name="getfinancing_test" value="1" checked="checked" />
                         <?php echo $text_yes; ?>
                         <?php } else { ?>
                       <input type="radio" name="getfinancing_test" value="1" />
                         <?php echo $text_yes; ?>
                           <?php } ?>
                           <?php if (!$getfinancing_test) { ?>
                       <input type="radio" name="getfinancing_test" value="0" checked="checked" />
                         <?php echo $text_no; ?>
                         <?php } else { ?>
                         <input type="radio" name="getfinancing_test" value="0" />
                           <?php echo $text_no; ?>
                         <?php } ?>
                       </td>
                     </tr>



                     <tr>
                        <td><?php echo $entry_status; ?></td>

                    <td>


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
                  </td></tr>

                  <tr>
                    <td><?php echo $entry_sort_order; ?></td>
                    <td>
                      <input type="text" name="getfinancing_sort_order" value="<?php echo $getfinancing_sort_order; ?>"  id="input-sort-order" placeholder="<?php echo $entry_sort_order; ?>"/>
                    </td>
                  </tr>




                          </table>
                          </form>
                          </div>
                          </div>
                          </div>
                          <?php echo $footer; ?>
