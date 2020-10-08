<?php

    function currencySymbol($currency){

        switch($currency){
            default: return '$';
            case 'gbp': return '£';
            case 'eur': return '€';
        }
    }

?>