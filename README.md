# Moneris API (USA) library

Improved Moneris library for Moneris API (USA) payment method.


### Payment methods

Moneris API payment method description:
https://developer.moneris.com/Downloads/US/APIs.aspx


### Original library

Original version 3.2.0 of this library can be found at:
https://developer.moneris.com/Downloads/US/APIs/Copy%20of%20Basic%20Transaction%20Functions.aspx


### Changes

Original library was updated to support the following new features:

* [support for production servers]

  Original library has test server hostname hardcoded in mpgGlobals class.
  To use the production server the library needs to be manually edited
  (see Chapter 24 "How Do I Configure My Store For Production?" of eSelectPlus
  Merchant Integration Guide). This change adds both test and production server
  hostnames, and the required one could be selected using a new optional
  parameter to mpgHttpsPost::mpgHttpsPost() method.

* [support for CA root certificates]

  Original library doesn't support using CA root certificate out of the box,
  forcing a user to modify the library manually if they want to use this (see
  Chapter 21 "How Do I Test My Solution?" of eSelectPlus Merchant Integration
  Guide). This change introduces this feature, providing an option to specify
  certificate file path in a new optional parameter to
  mpgHttpsPost::mpgHttpsPost() method.

* [support for fetching cURL responses]

  Original cURL response and error message (if any) are not being made available
  by the library to the calling system. Original library returns vague "Global
  Error Receipt" error instead. This update provides two new methods of
  mpgHttpsPost class to get original cURL response and cURL error (if any).




[support for production servers]:https://github.com/maciejzgadzaj/moneris-api-ca/commit/f5f1b6cdef5a338ec88c3e7b0f1bacd5e70369e3
[support for CA root certificates]:https://github.com/maciejzgadzaj/moneris-api-ca/commit/1444a911099ff83d5a6de0c10ce54852ec8272a5
[support for fetching cURL responses]:https://github.com/maciejzgadzaj/moneris-api-ca/commit/fda05c29953936a28d0adc62e9ebf42bd4cd4e93
