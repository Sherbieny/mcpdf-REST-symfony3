<?php
/**
 * Created by PhpStorm.
 * User: sherbieny
 * Date: 8/1/17
 * Time: 4:41 PM
 */

namespace AppBundle\Controller;


use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;


class MpdfController extends FOSRestController
{

    /**
     *
     * @Rest\Get("/create")
     */
    public function createPDFAction(){
        $mpdfService = $this->get('tfox.mpdfport');
        $html = "<h1> Hello </h1>";
//        $mpdf->allow_charset_conversion=true;
//        $mpdf->charset_in = 'iso-8859-4';
        $mpdf = $mpdfService->getMpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;

    }

    /**
     * @param $htmlSource
     * @Rest\Get("/create/{htmlSource}")
     */
    public function createPDFFromSourceAction($htmlSource){
        $mpdfService = $this->get('tfox.mpdfport');
        $html = file_get_contents($htmlSource);
        $mpdf = $mpdfService->getMpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
    }



}