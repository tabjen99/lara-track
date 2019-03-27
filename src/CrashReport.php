<?php

namespace miketan\laravelSimpleTrelloErrorReporting;

use Illuminate\Database\Eloquent\Model;

class CrashReport extends Model
{
    protected $table = 'crash_report';

    protected $fillable = [
        'subject','content'
    ];
}
