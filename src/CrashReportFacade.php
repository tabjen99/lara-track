<?php
namespace miketan\laraTrack;

use Illuminate\Support\Facades\Facade;

class CrashReportFacade extends Facade
{
    protected static function getFacadeAccessor() { 

        return 'crashReport';
    }
}