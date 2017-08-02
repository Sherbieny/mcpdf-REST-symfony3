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


class MpdfController extends FOSRestController
{

    /**
     *
     * @Rest\Get("/create")
     */
    public function createPDFAction(){
        $mpdfService = $this->get('tfox.mpdfport');
        $html = "zz";
        $html2 = "<h1> Hello </h1>";
        $mpdf = $mpdfService->getMpdf(['tempDir' => __DIR__.'/tmp']);
//        $mpdf->allow_charset_conversion=true;
//        $mpdf->charset_in = 'iso-8859-4';

        $mpdf->WriteHTML($html2);
        $mpdf->Output();
        exit;

    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Rest\Get("/create/{htmlSource}")
     */
    public function generatePDFAction($htmlSource){
        $mpdfService = $this->get('tfox.mpdfport');
        $html = "zz";
        $html2 = file_get_contents($htmlSource);
        $mpdf = $mpdfService->getMpdf();
//        $mpdf->allow_charset_conversion=true;
//        $mpdf->charset_in = 'iso-8859-4';
        $mpdf->debug = true;
        $mpdf->WriteHTML($html2);
        $mpdf->Output();
        exit;
    }



}