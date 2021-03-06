<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Amazon by Cedcommerce Failed-Order Email</title>
    <style type="text/css">
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }
        
        .stack-column-center {
            display: inline-block !important;
        }
        /* Media Queries */
        
        @media screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
            }
            .email-inner-container {
                width: 84% !important;
            }
            .fluid,
            .fluid-centered {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }
            .fluid-centered {
                margin-left: auto !important;
                margin-right: auto !important;
            }
            .stack-column-center {
                width: 48% !important;
                direction: ltr !important;
                max-width: 100% !important;
                text-align: center !important;
            }
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }
        }
    </style>
</head>

<body bgcolor="#eeeeee" width="100%" style="margin:0;">
    <!-- email header starts -->
    <table cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin:auto;" class="email-container">
        <!-- banner section starts -->
        <tbody>
            <tr>
                <td>
                    <img src="{{ basehomeurl }}/images/email-banner.png" width="600" height="" alt="alt_text" border="0" align="center" style="width:100%;max-width:600px;">
                </td>
            </tr>
            <!-- banner section ends -->
        </tbody>
    </table>
    <!-- email header ends -->
    <!-- email body starts -->
    <table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="600" style="margin:auto;" class="email-container">
        <!-- main content starts -->
        <tbody>
            <tr>
                <td>
                    <img src="{{ basehomeurl }}/images/amazon-banner.png" width="600" height="" alt="alt_text" border="0" align="center" style="width:100%;max-width:600px;">
                </td>
            </tr>
            <tr>
                <td style="padding:30px 30px 10px;font-size:14px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;line-height:22px;color:#666666;">
                    Greetings {{ name }},
                    <br><br> We hope this mail finds you in good health.
                    <br><br> Your online business activities look in good shape, however we???ve stumbled upon a few failed orders, details for the same can be listed down as follows:
                    <br><br>
                    <b>Your immediate attention is required as some of the orders from Amazon have failed while creating them on Shopify. Please look at the following specifications about the failed orders:</b>
                </td>
            </tr>
            <tr>
                <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                    <div style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:17px;font-weight:400;line-height:24px;text-align:left;color:#2c2c2c;">
                        <table width="100%" style="border:1px solid #333333;border-collapse: collapse;">
                            <colgroup>
                                <col style="width: 25.3%;">
                                <col style="width: 29.3%;">

                            </colgroup>
                            <thead>
                                <tr>

                                    <th style="border:1px solid #333333;color:#2c2c2c;padding: 5px 10px;font-size: 14px;">order Id
                                    </th>
                                    <th style="border:1px solid #333333;color:#2c2c2c;padding: 5px 10px;font-size: 14px;">Reason
                                    </th>


                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="border:1px solid #333333;color:#2c2c2c;padding: 5px 10px;font-size: 14px;">
                                        {{ var shopurl }}
                                    </td>
                                    <td style="border:1px solid #333333;color:#2c2c2c;padding: 5px 10px;font-size: 14px;">
                                        {{ var wish_order_id }}
                                    </td>

                                </tr>
                                <tr>
                                    <td style="border:1px solid #333333;color:#2c2c2c;padding: 5px 10px;font-size: 14px;">
                                        {{ var shopurl }}
                                    </td>
                                    <td style="border:1px solid #333333;color:#2c2c2c;padding: 5px 10px;font-size: 14px;">
                                        {{ var wish_order_id }}
                                    </td>

                                </tr>
                                <tr>
                                    <td style="border:1px solid #333333;color:#2c2c2c;padding: 5px 10px;font-size: 14px;">
                                        {{ var shopurl }}
                                    </td>
                                    <td style="border:1px solid #333333;color:#2c2c2c;padding: 5px 10px;font-size: 14px;">
                                        {{ var wish_order_id }}
                                    </td>

                                </tr>
                                <tr>
                                    <td style="border:1px solid #333333;color:#2c2c2c;padding: 5px 10px;font-size: 14px;">
                                        {{ var shopurl }}
                                    </td>
                                    <td style="border:1px solid #333333;color:#2c2c2c;padding: 5px 10px;font-size: 14px;">
                                        {{ var wish_order_id }}
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding:30px;font-size:14px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;line-height:22px;color:#666666;">In order to successfully create your order which failed due to missing SKU, on Shopify, you need to create a product on the Shopify store with the same details and SKU as on Amazon. In case the product exists on Shopify you need to link
                    it by updating the SKU same as the one on Amazon. For more information on why some of your orders failed or how to successfully create orders that have failed you can check out this <a target="_blank" href="https://docs.cedcommerce.com/shopify/amazon-channel-cedcommerce/?section=fail-orders">resource  </a>                    or seek out assistance here:
                    <br></td>
            </tr>
            <tr>
                <td style="padding:30px;font-size:14px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;line-height:22px;color:#666666;">
                    However, you can take care of these issues. All you have to do is visit the Shopify store and manage the things you wish to.
                    <br><br> Sincerely yours,
                    <br> Team CedCommerce
                </td>
            </tr>
            <!-- main content ends -->
        </tbody>
    </table>
    <!-- email body ends -->
    <!-- support section starts -->
    <table cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="padding:30px 30px 0;text-align:center;" bgcolor="#f5f7f9" class="email-container">
        <tbody>
            <tr>
                <td width="32%" class="stack-column-center" valign="top" style="padding-bottom:30px;">
                    <table cellspacing="0" cellpadding="0" border="0" align="center">
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ basehomeurl }}/images/customer-service.png" width="30" height="30" alt="alt_text" border="0" class="fluid">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;line-height:20px;" class="center-on-narrow">
                                    <p style="color:#000000;font-weight:bold;margin:8px 0;">Voice Support</p>
                                    <span style="color:#666666;display:block;">USA: +1 (888)882-0953</span>
                                    <span style="color:#666666;display:block;">(Toll Free)</span>
                                    <span style="color:#666666;display:block;">INDIA: +91 7234976892</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="32%" class="stack-column-center" valign="top" style="padding-bottom:30px;">
                    <table cellspacing="0" cellpadding="0" border="0" align="center">
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ basehomeurl }}/images/calendly.png" width="30" height="30" alt="alt_text" border="0" class="fluid">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;line-height:20px;" class="center-on-narrow">
                                    <p style="color:#000000;font-weight:bold;margin:8px 0;">Calendly</p>
                                    <span style="color:#666666;display:block;">Schedule meeting with us</span>
                                    <a href="https://calendly.com/scale-business-with-cedcommerce/shopify-amazon-integration" target="_blank" style="color:#333333;font-size:12px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;display:block;">Schedule Meet</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="32%" class="stack-column-center" valign="top" style="padding-bottom:30px;">
                    <table cellspacing="0" cellpadding="0" border="0" align="center">
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ basehomeurl }}/images/speech-bubble.png" width="30" height="30" alt="alt_text" border="0" class="fluid">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;line-height:20px;" class="center-on-narrow">
                                    <p style="color:#000000;font-size:12px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:bold;margin:8px 0;">Instant Chat</p>
                                    <span style="color:#666666;font-size:12px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;display:block;">Connect to us on Live Chat</span>
                                    <a href="https://tawk.to/chat/5ca1b56a6bba460528009d93/default" target="_blank" style="color:#333333;font-size:12px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;display:block;">Connect Us</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
            </tr>
            <tr>
                <td width="32%" class="stack-column-center" valign="top" style="padding-bottom:30px;">
                    <table cellspacing="0" cellpadding="0" border="0" align="center">
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ basehomeurl }}/images/mail.png" width="30" height="30" alt="alt_text" border="0" class="fluid">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;line-height:20px;" class="center-on-narrow">
                                    <p style="color:#000000;font-size:12px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:bold;margin:8px 0;">Email Support</p>
                                    <a href="mailto:channel-support@cedcommerce.com" target="_blank" style="color:#333333;font-size:12px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;display:block;">Mail Us</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="32%" class="stack-column-center" valign="top" style="padding-bottom:30px;">
                    <table cellspacing="0" cellpadding="0" border="0" align="center">
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ basehomeurl }}/images/skype.png" width="30" height="30" alt="alt_text" border="0" class="fluid">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;line-height:20px;" class="center-on-narrow">
                                    <p style="color:#000000;font-weight:bold;margin:8px 0;">Skype Support</p>
                                    <a href="https://join.skype.com/xV5r9L7s6jFG" target="_blank" style="color:#333333;display:block;">Support: Amazon Channel by CedCommerce</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="32%" class="stack-column-center" valign="top" style="padding-bottom:30px;">
                    <table cellspacing="0" cellpadding="0" border="0" align="center">
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ basehomeurl }}/images/whatsapp.png" width="30" height="30" alt="alt_text" border="0" class="fluid">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;line-height:20px;" class="center-on-narrow">
                                    <p style="color:#000000;font-size:12px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:bold;margin:8px 0;">Live Chat on Whatsapp</p>
                                    <a href="https://chat.whatsapp.com/GOFQ2Gsg7rdBjBSzE9NGAA" target="_blank" style="color:#333333;display:block;">Chat Now</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- support section starts -->
    <!-- email footer starts -->
    <table cellspacing="0" cellpadding="0" border="0" width="600" bgcolor="#fbfbfb" class="email-container" style="margin:auto;">
        <!-- address section starts -->
        <tbody>
            <tr>
                <td width="60%" class="stack-column" valign="top" style="padding:30px;">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td style="padding:0 0 15px;color:#333333;font-weight: 800;font-size: 14px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;text-transform: uppercase;">
                                    Address
                                </td>
                            </tr>
                            <tr>
                                <td style="color:#000000;line-height:20px;font-size:13px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;">
                                    CedCommerce Inc.
                                    <br> 1B12 N Columbia Blvd Suite
                                    <br> C15-653026 Portland, Oregon, 97217, USA
                                    <br><br>
                                    <a href="https://www.facebook.com/CedCommerce/" target="_blank" style="display:inline-block;margin-right:30px;">
                                        <img title="Facebook" src="{{ basehomeurl }}/images/facebook.png" alt="fb" width="24px">
                                    </a>
                                    <a href="https://twitter.com/cedcommerce" target="_blank" style="display:inline-block;margin-right:30px;">
                                        <img title="Twitter" src="{{ basehomeurl }}/images/twitter.png" alt="tw" width="24px">
                                    </a>
                                    <a href="https://www.instagram.com/cedcommerce/" target="_blank" style="display:inline-block;">
                                        <img title="Instagram" src="{{ basehomeurl }}/images/instagram.png" alt="ig" width="24px">
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="18%" class="stack-column" valign="top" style="padding:40px 30px 30px 0;text-align:right;">
                    <img src="{{ basehomeurl }}/images/ced-symbol.png" width="80" height="80" alt="amazon-by-cedcommerce" border="0" class="fluid">
                </td>
            </tr>
            <!-- address section ends -->
        </tbody>
    </table>
    <!-- email footer ends -->

</body>

</html>