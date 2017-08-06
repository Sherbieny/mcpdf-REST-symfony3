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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class XfdfController extends FOSRestController
{

   /**
     * @Rest\Post("/convert/")
     */
    public function getDataAction(Request $request){
        // Change the path to your jar file location
        $jarfile = "/home/sherbieny/Documents/Work/Tecla/MCPDF/mcpdf.jar";

        // Change the path to your prefered destination where the output file will be created
        $result = "/home/sherbieny/Documents/Work/Tecla/MCPDF/output.pdf";

        $form = $request->get('form');
        $data = $request->get('data');

        if(is_null($data) || $data == ""){
            return new View('Data source not found', Response::HTTP_NO_CONTENT);
        }elseif(is_null($form) || $form == ""){
            return new View('Form source not found', Response::HTTP_NO_CONTENT);
        }

        $command = "java -jar $jarfile $form fill_form - output - < $data > $result";

        $result = exec($command, $output);

        // dump($result);
        exit;

        }

}