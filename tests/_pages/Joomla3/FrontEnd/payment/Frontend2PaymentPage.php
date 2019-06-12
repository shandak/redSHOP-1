<?php


class Frontend2PaymentPage extends FrontEndProductManagerJoomla3Page
{

    /**
     * @var string
     * @since 2.1.2
     */
    public static $payment2checkout = "//input[@value='rs_payment_2checkout']";

    /**
     * @var string
     * @since 2.1.2
     */
    public static $secureCheckout = "Secure Checkout";

    /**
     * @var string
     * @since 2.1.2
     */
    public static $reviewCart  = "//section[@id='review-cart']/button";

    /**
     * @var string
     * @since 2.1.2
     */
    public static $shippingAddress1 = "//input[@id='shipping-address-1']";

    /**
     * @var string
     * @since 2.1.2
     */
    public static $shippingInformation = "//section[@id='shipping-information']/button";

    /**
     * @var string
     * @since 2.1.2
     */
    public static $checkboxSamAsShipping = "//input[@id='same-as-shipping']";

    /**
     * @var string
     * @since 2.1.2
     */
    public static $billingInformation = "//section[@id='billing-information']/button";

    /**
     * @var string
     * @since 2.1.2
     */
    public static $inputCartNumber = "//input[@id='card-number']";

    /**
     * @var string
     * @since 2.1.2
     */
    public static $buttonPayment2Checkout = "//section[@id='payment-method']/div[2]/button";

    /**
     * @var string
     * @since 2.1.2
     */
    public static $message2CheckoutSuccess = 'Your payment has been processed';
}