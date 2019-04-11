<?php

namespace AppBundle\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Unirest;

class BlackController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client= new Client();
    }

    public function indexAction()
    {
        $url = 'https://adneomapisubject.herokuapp.com/php-test-technique/episodes';

        $headers = array('Accept' => 'application/json','X-Auth-Token'=> 'TokenADNTest2018');
        $aResponse = Unirest\Request::get($url,$headers);

        $aList = $aResponse->body->resources->_embedded->episodes;
        $aSerie = $aResponse->body->resources;

        return $this->render('BlackMirror/index.html.twig', array(

            'serie' => $aSerie,
            'listEpisodes' => $aList));
    }

    public function viewsAction($id)
    {
        $url = 'https://adneomapisubject.herokuapp.com/php-test-technique/episodes/'.$id;

        $headers = array('Accept' => 'application/json','X-Auth-Token'=> 'TokenADNTest2018');
        $aResponse2 = Unirest\Request::get($url,$headers);

        $aEpisode= $aResponse2->body->resources;

        return $this->render('BlackMirror/views.html.twig', array('episode'=> $aEpisode,'id' => $id));
    }
}