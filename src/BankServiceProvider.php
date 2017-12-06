<?php
namespace Vki\Bank;

use Config;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class BankServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
       // $this->registerGolomt();
        $this->registerKhan();
        $this->app->bindShared('Vki\Bank\PaymentManager', function () {
            $manager = new PaymentManager();
            return $manager->with(Config::get('payment.default'));
        });
    }
//    /**
//     * Голомт банкийг бүртгэх.
//     */
//    private function registerGolomt()
//    {
//        $this->app->bindShared('Selmonal\Payment\Gateways\Golomt\Gateway', function () {
//            return new GolomtGateway(
//                Config::get('payment.gateways.golomt.merchant_id'),
//                Config::get('payment.gateways.golomt.request_action'),
//                Config::get('payment.gateways.golomt.subID')
//            );
//        });
//        $this->app->bindShared('Selmonal\Payment\Gateways\Golomt\TransactionValidator', function () {
//            return new TransactionValidator(
//                Config::get('payment.gateways.golomt.soap_username'),
//                Config::get('payment.gateways.golomt.soap_password'),
//                Config::get('payment.gateways.golomt.wsdl')
//            );
//        });
//    }
    /**
     * Хаан банкийг бүртгэх
     */
    private function registerKhan()
    {
        $this->app->bindShared('Vki\Bank\Gateways\Khan\Gateway', function () {
            return new KhanGateway(
                new Client(),
                Config::get('payment.gateways.khan.username'),
                Config::get('payment.gateways.khan.password')
            );
        });
    }


}