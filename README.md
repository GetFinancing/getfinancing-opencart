getFinancing-opencart
=====================

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
