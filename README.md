getFinancing-opencart
=====================

General Instructions
-----------------------------
1. Create your merchant account to offer monthly payment options to your consumers directly on your ecommerce from here (http://www.getfinancing.com/signup) if you haven't done it yet.
2. Download our module from the latest release here (https://github.com/GetFinancing/getfinancing-opencart/releases) or all the code in a zip file from here (https://github.com/GetFinancing/getfinancing-opencart/archive/master.zip)
3. Setup the module with the information found under the Integration section on your portal account https://partner.getfinancing.com/partner/portal/. Also remember to change the postback url on your account for both testing and production environments.
4. Once the module is working properly and the lightbox opens on the request, we suggest you to add some conversion tools to your store so your users know before the payment page that they can pay monthly for the purchases at your site. You can find these copy&paste tools under your account inside the Integration section.
5. Check our documentation (www.getfinancing.com/docs) or send us an email at (integrations@getfinancing.com) if you have any doubt or suggestions for this module. You can also send pull requests to our GitHub account (http://www.github.com/GetFinancing) if you feel you made an improvement to this module.


Installing the module
---------------------
- unzip the .zip file
- use 1.5.x or 2.0.x-2.1.x depending on your opencart version
- copy over the app and lib trees


Activating the module
---------------------
 - Go to the admin backoffice
 - At the top, go to Modules > Payments
 - Click the install icon on the Get Financing option
 - Under GetFinancing:
   - Set Enabled to YES
   - Fill in Merchant ID
   - Fill in username
   - Fill in password


Testing
-------

In the complete integration guide that you can download from our portal,
you can see various test personae that you can use for testing.

Switching to production
-----------------------

 - Go to the admin backoffice
 - At the top, go to Modules > Payments
 - Under 'GetFinancing', switch the Test Mode to NO.

Module notes
------------
 - when checking out with GetFinancing, the quote only gets converted to
   an order after the loan has been preapproved.  This allows for easy
   rollback to other payment methods in case the loan is not preapproved.

 - Configure the postback url in the GetFinancing portal as
   index.php?route=payment/getfinancing/callback
   prefixed with your domain
