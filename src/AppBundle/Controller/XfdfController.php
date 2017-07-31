<?php
/**
 * Created by PhpStorm.
 * User: sherbieny
 * Date: 7/26/17
 * Time: 3:04 PM
 */

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class XfdfController extends FOSRestController
{
    /**
     * @Route("/convert", name="default_convert")
     *
     */
    public function populateFormAction(){



        $pdfForm = "/home/sherbieny/Documents/Work/Tecla/MCPDF/sample.pdf";

        $xfdfFile = "/home/sherbieny/Documents/Work/Tecla/MCPDF/sample.xfdf";

        $jarfile = "/home/sherbieny/Documents/Work/Tecla/MCPDF/mcpdf.jar";

        $result = "/home/sherbieny/Documents/Work/Tecla/MCPDF/output.pdf";

        $command = "java -jar $jarfile $pdfForm fill_form - output - < $xfdfFile > $result";


        $out = exec($command, $output);
        //dump($output);
        dump($out);






        return $this->render('default/convert.html.twig');


    }

   /**
     * @param $form
     * @param $data
     * @return string
     * @Rest\Get("/convert/{form}/{data}")
     */
    public function getDataAction($form, $data){

        // Change the path to your jar file location
        $jarfile = "/home/sherbieny/Documents/Work/Tecla/MCPDF/mcpdf.jar";

        // Change the path to your prefered destination where the output file will be created
        $result = "/home/sherbieny/Documents/Work/Tecla/MCPDF/output.pdf";

        $command = "java -jar $jarfile $form fill_form - output - < $data > $result";

        $result = exec($command, $output);


        return $result;
    }

}