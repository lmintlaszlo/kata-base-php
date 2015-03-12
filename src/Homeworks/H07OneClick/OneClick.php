<?php

namespace Kata\Homeworks\H07OneClick;

interface OneClick
{
    const METHOD_EPOCH  = 'epoch';
    const METHOD_CCBILL = 'ccbill';
    
    const PARAM_METHOD = 'oncelick_method';
    const PARAM_PARAMS = 'oncelick_params';
    
    public function getRequiredParams();
}
