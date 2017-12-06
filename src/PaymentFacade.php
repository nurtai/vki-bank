<?php
namespace Vki\Bank;
use Illuminate\Support\Facades\Facade;

class PaymentFacade extends Facede
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Vki\Bank\PaymentManager';
    }
}