<?php
namespace miketan\laravelSimpleTrelloErrorReporting;

use Illuminate\Support\Facades\Facade;

class CrashReportFacade extends Facade
{
    protected static function getFacadeAccessor() { 

        return 'miketan\laravelSimpleTrelloErrorReporting\CrashReport';
    }
}