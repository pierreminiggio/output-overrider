<?php

namespace PierreMiniggio\OutputOverrider;

use Closure;
use Exception;

class OutputOverrider
{

    public Closure $overrider;

    public function __construct()
    {
        $this->overrider = function (string $string) {
        };
    }
    
    public function getStdOutContent(Closure $outputProducingCall): string
    {
        $output = '';
        try {
            ob_start($this->overrider);
            $outputProducingCall();
            $output .= ob_get_contents();
            ob_end_clean();
            
            return $output;
        } catch (Exception $e) {
            ob_end_clean();
            throw $e;
        }
    }
}
