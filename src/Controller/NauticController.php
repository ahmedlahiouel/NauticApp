<?php

namespace App\Controller;


use App\Entity\NauticBase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class NauticController extends Controller
{
    private $validato;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validato = $validator;

    }

    /**
     * Lists all Nautic Base .
     * @FOSRest\Get("/Nautics")
     *
     *
     */
    public function getNauticsAction()
    {
        $repository = $this->getDoctrine()->getRepository(NauticBase::class);
// recuperation de liste
        $Nautics = $repository->findall();
//recuperer le tableau des objets et creer un autre tableau contenant contenant que le nom et la description
        $res = array();
        foreach ($Nautics as $elem) {
            $res["name"] = $elem->getName();
            $res["description"] = $elem->getDescription();


        }

// encoder json resultat et afficher
        $c = $this->get('serializer')->serialize(array('code' => 0, "message" => ' 0 ', "errors" => '0', "result" => $res), 'json');
        $response = new Response($c);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Create NauticBase.
     * @FOSRest\Post("/Nautics")
     *
     *
     */
    public function postUserAction(Request $request)
    {
        $data = $request->getContent();
        $User = $this->get('serializer')->deserialize($data, 'App\Entity\NauticBase', 'json');
        // validation de nautic base
        $errors = $this->validato->validate($User);
// verification sur la validation
        if (count($errors) > 0) {
            $c = $this->get('serializer')->serialize(array('code' => 1, "messgae" => "error Arguments", "errors" => "Arguments Errors"), 'json');
            $response = new Response($c);
            $response->headers->set('Content-Type', 'application/json');

            return $response;


        } else {
            $em = $this->getDoctrine()->getManager();
            $em->persist($User);
            $em->flush();


            $c = $this->get('serializer')->serialize(array('code' => 0, "messgae" => 'OK', "errors" => 0, "result" => "valide"), 'json');

            $response = new Response($c);
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        }
    }


    /**
     * Delete a NauticBase entity.
     *
     * @Route("/Nautics/{id}", name="delete_Nautic")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $modeles1 = $this->getDoctrine()->getRepository(NauticBase::class)->findoneBy(array('id' => $id));

        $em = $this->getDoctrine()->getManager();
        if ($modeles1 == null) {
            $c = $this->get('serializer')->serialize(array('code' => 0, "message" => ' objet n existe pas', "errors" => 0), 'json');
            $response = new Response($c);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        } else {
            $em->remove($modeles1);
            $em->flush();
            $c = $this->get('serializer')->serialize(array('code' => 1, "message" => ' supprimé  ', "errors" => 1), 'json');
            $response = new Response($c);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }

    /**
     * Update a NauticBase entity.
     *
     * @Route("/Nautic/{id}", name="update_Nautic")
     * @Method("PUT")
     */
    public function UpdateAction(Request $request, $id)
    { // chercher Nautic object a modifier
        $modeles1 = $this->getDoctrine()->getRepository(NauticBase::class)->findoneBy(array('id' => $id));
// tester existance de l'objet
        if ($modeles1 == null) {
            $c = $this->get('serializer')->serialize(array('code' => 0, "message" => ' objet n existe pas', "errors" => 0), 'json');
            $response = new Response($c);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        } else {

            $data = $request->getContent();
            $User = $this->get('serializer')->deserialize($data, 'App\Entity\NauticBase', 'json');
            // validation de nautic base
            $errors = $this->validato->validate($User);
            if (count($errors) > 0) {
                $c = $this->get('serializer')->serialize(array('code' => 0, "messgae" => "error Arguments", "errors" => "Arguments Errors"), 'json');
                $response = new Response($c);
                $response->headers->set('Content-Type', 'application/json');

                return $response;


            } else {
                //modification
                $modeles1->setName($User->getName());
                $modeles1->setDescription($User->getDescription());
                $modeles1->setAdresse($User->getAdresse());
                $modeles1->setCity($User->getCity());
                $modeles1->setPostalCode($User->getPostalCode());


                $em = $this->getDoctrine()->getManager();
                $em->persist($modeles1);
                $em->flush();
                $c = $this->get('serializer')->serialize(array('code' => 1, "message" => ' oui ', "errors" => 'oui', "result" => "modfié"), 'json');
                $response = new Response($c);
                $response->headers->set('Content-Type', 'application/json');
                return $response;

            }


        }
    }


    /**
     * Lists  Nautic Base detail  .
     * @FOSRest\Get("/Nautic_get/{id}")
     *
     *
     */
    public function get_Nautic_detailleAction(Request $request, $id)
    {
        $modeles1 = $this->getDoctrine()->getRepository(NauticBase::class)->findoneBy(array('id' => $id));
//tester existance de l'objet
        if ($modeles1 == null) {
            $c = $this->get('serializer')->serialize(array('code' => 0, "message" => ' objet n existe pas', "errors" => 0), 'json');
            $response = new Response($c);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        } else {
            $c = $this->get('serializer')->serialize(array('code' => 1, "message" => ' oui ', "errors" => 'non', "result" => $modeles1), 'json');
            $response = new Response($c);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }

    // creation d'une reponse identique au convention de construire une api code,message,error,resultat

    public function ConstruireRep(array $rep)
    {
        if ($rep == null) {
            $c = $this->get('jms_serializer')->serialize((array('code' => 1, "message" => "il ya des erreurs", "errors" => $rep, "result" => $rep)), 'json');
            $response = new Response($c);
            $response->headers->set('Content-Type', 'application/json');

            return $response;


        } else {

            $c = $this->get('jms_serializer')->serialize((array('code' => 0, "message" => 0, "errors" => 0, "result" => $rep)), 'json');
            $response = new Response($c);
            $response->headers->set('Content-Type', 'application/json');

            return $response;

        }


    }


}