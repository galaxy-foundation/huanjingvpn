<?php

namespace App\Http\Middleware;

use App\Client;
use \Closure;
use Illuminate\Http\Request;

class StartSession extends \Illuminate\Session\Middleware\StartSession{

    /**
     * Session timeout, in seconds. A new session id will be generated after TIMEOUT;
     */
    const TIMEOUT = 10;

    /**
     * The client connected to session
     * @var \App\Client;
     */
    protected $client;

    protected function setClient(Client $client){
        $this->client = $client;
    }

    protected function getClient(){
        return $this->client;
    }
    
    protected function startSession(Request $request) {
        return tap($this->getSession($request), function ($session) use ($request) {
            $session->setRequestOnHandler($request);

            $session->start();
        });
    }
    public function getSession(Request $request) {
        $url=$request->getRequestUri();
        $ext=pathinfo($url, PATHINFO_EXTENSION);
        if($ext) return null;

        return tap($this->manager->driver(), function ($session) use ($request, $url) {
            $token='';
            if($request->has('uuid')) {
                $token=$request->uuid;
                if(strlen($token)!=40) $token="";
            }
            /* if(preg_match("'/(.[^/]*)/'",$url,$matches)) {
                $token=$matches[1];
            }else{
                $token="";
            } */
            $session->setId($token);
        });
    }
    public function handle($request, Closure $next){
        $token      = $request->query->get('token') ?: $request->headers->get('X-TOKEN');
        $validToken = true;
        if( $token and $validToken ){
            return parent::handle($request, $next);
        } else {
            $validSignature  = true;
            if( $validSignature ){
                return parent::handle($request, $next);
            }else{
                throw new \Exception('Invalid signature!');
            }
        }
    }
    protected function addCookieToResponse($request, $response)
    {
        /* $config = config('session');
    
        $response->headers->setCookie(
            new Cookie(
                'XSRF-TOKEN', $request->session()->token(), time() + 60 * 120,
                $config['path'], $config['domain'], false, false
            )
        ); */
    
        return $response;
    }
}
