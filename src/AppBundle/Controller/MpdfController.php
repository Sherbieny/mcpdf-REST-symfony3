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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class MpdfController extends FOSRestController
{


    /**
     * @Rest\Post("/mPDF/")
     */
    public function createPDFAction(Request $request){
        $source = $request->get('source');
        if($source == ""){
            return new View('No Data found', Response::HTTP_NO_CONTENT);
        }
        $mpdfService = $this->get('tfox.mpdfport');
        $html = file_get_contents($source);
        $mpdf = $mpdfService->getMpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;

    }
//
//    /**
//     * @param $htmlSource
//     * @Rest\Get("/create/{htmlSource}")
//     */
//    public function createPDFFromSourceAction($htmlSource){
//        $mpdfService = $this->get('tfox.mpdfport');
//        $html = file_get_contents($htmlSource);
//        $mpdf = $mpdfService->getMpdf();
//        $mpdf->WriteHTML($html);
//        $mpdf->Output();
//        exit;
//    }



}