<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    use HasFactory;

    public function store($request)
    {
        $log = new SystemLog;
        $log->user_id = auth()->user() ? auth()->user()->id : (auth('api')->user() ? auth('api')->user()->id : 0);
        $log->user_agent = $request->server('HTTP_USER_AGENT') ?? 'Mozilla/5.0 (X11; Ubuntu; Linux i686 on x86_64; rv:47.0) Gecko/20100101 Firefox/47.0';
        $log->ip = $request->ip() ?? '127.0.0.1';
        $log->http_code = $request->server('REDIRECT_STATUS') ?  $request->server('REDIRECT_STATUS') : 200;
        $log->path = $request->path();
        $log->action = $request->method();
        $log->payload =   $request->path() !== 'api/auth/login' ?  json_encode($request->all()) : '';
        $log->save();
    }
}
