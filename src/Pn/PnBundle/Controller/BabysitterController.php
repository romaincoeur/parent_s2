<?php

namespace Pn\PnBundle\Controller;

use FOS\UserBundle\Entity\User;
use Proxies\__CG__\Pn\PnBundle\Entity\Recommendation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pn\PnBundle\Entity\Babysitter;
use Pn\PnBundle\Form\BabysitterType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Pn\PnBundle\Form\RecommendationType;


/**
 * Babysitter controller.
 *
 */
class BabysitterController extends Controller
{

    /**
     * Lists all Babysitter entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PnPnBundle:Babysitter')->findAllOrderedByTrustpoints();

        // gestion du calendrier
        $calendarService = $this->container->get('pn.calendar');
        $calendar = $calendarService->newMatrix();

        return $this->render('PnPnBundle:Babysitter:index.html.twig', array(
            'entities' => $entities,
            'calendarMatrix' => $calendar
        ));
    }

    /**
     * Lists Babysitter entities.
     *
     */
    public function searchAction($search)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PnPnBundle:Babysitter')->getFromSearch($search);

        // gestion du calendrier
        $calendarService = $this->container->get('pn.calendar');
        $calendar = $calendarService->newMatrix();

        return $this->render('PnPnBundle:Babysitter:index.html.twig', array(
            'entities' => $entities,
            'calendarMatrix' => $calendar
        ));
    }

    /**
     * Creates a new Babysitter entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Babysitter();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('babysitter_show', array('id' => $entity->getId())));
        }

        return $this->render('PnPnBundle:Babysitter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Babysitter entity.
     *
     * @param Babysitter $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Babysitter $entity)
    {
        $form = $this->createForm(new BabysitterType(), $entity, array(
            'action' => $this->generateUrl('babysitter_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Babysitter entity.
     *
     */
    public function newAction()
    {
        $entity = new Babysitter();
        $form   = $this->createCreateForm($entity);

        // gestion du calendrier
        $calendarService = $this->container->get('pn.calendar');
        $calendar = $calendarService->newMatrix();

        return $this->render('PnPnBundle:Babysitter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'calendarMatrix' => $calendar
        ));
    }

    /**
     * Finds and displays a Babysitter entity.
     *
     */
    public function showAction($id)
    {
        // Get babysitter from DB
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PnPnBundle:Babysitter')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Babysitter entity.');
        }

        // Get the calendar and transform it to matrix
        $calendarService = $this->container->get('pn.calendar');
        $calendar = $calendarService->getMatrix($entity->getCalendar());

        // Configure the recommendation form
        $form = $this->createForm(new RecommendationType(), new Recommendation(), array(
            'action' => $this->generateUrl('recommendation_send',array('to' => $id)),
            'method' => 'POST',
        ));


        return $this->render('PnPnBundle:Babysitter:show.html.twig', array(
            'entity'      => $entity,
            'calendarMatrix' => $calendar,
            'id' => $id,
            'recommendation_form' => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Babysitter entity.
     *
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Babysitter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Babysitter entity.');
        }

        $form = $this->createForm(new BabysitterType(), $entity);

        $form->handleRequest($request);

        if ($form->isValid()){
            $em->persist($entity);
            $em->flush();
        }

        // gestion du calendrier
        $calendarService = $this->container->get('pn.calendar');
        $calendar = $calendarService->getMatrix($entity->getCalendar());

        return $this->render('PnPnBundle:Babysitter:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $form->createView(),
            'calendarMatrix' => $calendar,
            'id' => $id
        ));
    }

    /**
     * Creates a form to edit a Babysitter entity.
     *
     * @param Babysitter $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Babysitter $entity)
    {
        $form = $this->createForm(new BabysitterType(), $entity, array(
            'action' => $this->generateUrl('babysitter_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }

    /**
     * Edits an existing Babysitter entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Babysitter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Babysitter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        $calendar = $this->createCalendar($entity->getCalendar());

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('babysitter_show', array('id' => $id)));
        }

        return $this->render('PnPnBundle:Babysitter:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'id'          => $id,
            'calendarMatrix'    => $calendar
        ));
    }

    /**
     * Deletes a Babysitter entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PnPnBundle:Babysitter')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Babysitter entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('babysitter'));
    }

    /**
     * Creates a form to delete a Babysitter entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('babysitter_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }

    /**
     * Edits an existing Babysitter entity.
     * AJAX
     *
     */
    public function updateFieldAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Babysitter')->find($id);
        $user = $entity->getUser();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Babysitter entity.');
        }

        // Get data
        if ($request->getMethod()=='POST')
        {
            $parameter = $request->request->get('parameter');
            $value = $request->request->get('value');
        }
        else
        {
            $parameter = $request->query->get('parameter');
            $value = $request->query->get('value');
        }

        // Update Parameter
        $response['success'] = false;
        switch ($parameter){
            case 'firstname':
                $user->setFirstname($value);
                break;
            case 'lastname':
                $user->setLastname($value);
                break;
            case 'rate_price':
                $entity->setRatePrice($value);
                break;
            case 'rate_type':
                $entity->setRateType($value);
                break;
            case 'presentation':
                $entity->setPresentation($value);
                break;
            case 'phone':
                $user->setPhone($value);
                break;
            case 'address':
                $user->setAddress($value);
                break;
            case 'latitude':
                $user->setLatitude($value);
                break;
            case 'longitude':
                $user->setLongitude($value);
                break;
            case 'birthdate_day':
                $birthdate = $user->getBirthdate();
                $d = $value;
                $m = $birthdate->format('m');
                $Y = $birthdate->format('Y');

                $user->setBirthdate(new \DateTime($Y.'-'.$m.'-'.$d));
                break;
            case 'birthdate_month':
                $birthdate = $user->getBirthdate();
                $d = $birthdate->format('d');
                $m = $value;
                $Y = $birthdate->format('Y');

                $user->setBirthdate(new \DateTime($Y.'-'.$m.'-'.$d));
                break;
            case 'birthdate_year':
                $birthdate = $user->getBirthdate();
                $d = $birthdate->format('d');
                $m = $birthdate->format('m');
                $Y = $value;

                $user->setBirthdate(new \DateTime($Y.'-'.$m.'-'.$d));
                break;
            case 'experience':
                $entity->setExperience($value);
                break;
            case 'diplomas':
                $entity->switchDiploma($value);
                break;
            case 'ageOfChildren':
                $entity->switchAgeOfChildren($value);
                break;
            case 'languages':
                $entity->switchLanguage($value);
                break;
            case 'particularite':
                $entity->switchParticularite($value);
                break;
            case 'extraTasks':
                $entity->switchExtraTask($value);
                break;
            case 'petitPlus':
                $entity->switchPetitsPlus($value);
                break;
            case 'favoriteactivities':
                $entity->setFavoriteActivities($value);
                break;
            case 'hobbies':
                $entity->setHobbies($value);
                break;
            default:
                $response['success'] = false;
                $response['message'] = 'wrong parameter';
                return new JsonResponse( $response );
        }

        $this->updateTrustpoints($entity);

        // Persist in DB
        $em->persist($entity);
        $em->persist($user);
        $em->flush();

        $response['success'] = true;
        //$response['message'] = $user->getBirthdate()->format( 'd - m - Y');

        // Response
        return new JsonResponse( $response );
    }

    /**
     * Edits a calendar.
     * AJAX
     *
     */
    public function updateCalendarAJAXAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $calendarService = $this->container->get('pn.calendar');

        $entity = $em->getRepository('PnPnBundle:Babysitter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Babysitter entity.');
        }

        $calendar = $calendarService->getMatrix($entity->getCalendar());

        // Get data
        if ($request->getMethod()=='POST')
        {
            $id = $request->request->get('coords');
            $value = $request->request->get('value');
        }
        else
        {
            $id = $request->query->get('coords');
            $value = $request->query->get('value');
        }
        $tab = explode("-", $id);
        $x = $tab[0];
        $y = $tab[1];

        // Update Parameter
        $response['success'] = false;

        // Remplacer la valeur
        $calendar[$x][$y] = $value;
        $entity->setCalendar($calendarService->getString($calendar));

        $this->updateTrustpoints($entity);

        // Persist in DB
        $em->persist($entity);
        $em->flush();

        $response['success'] = true;
        $response['id'] = $id;

        // Response
        return new JsonResponse( $response );
    }

    /**
     * Edits the address from Google Geocoder.
     * AJAX
     *
     */
    public function updateAddressAJAXAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Babysitter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Babysitter entity.');
        }

        // Get data
        if ($request->getMethod()=='POST')
        {
            $addressTab = json_decode($request->request->get('value'), true);
            $latitude = $request->request->get('latitude');
            $longitude = $request->request->get('longitude');
        }
        else
        {
            $addressTab = json_decode($request->query->get('value'), true);
            $latitude = $request->query->get('latitude');
            $longitude = $request->query->get('longitude');
        }

        // Remplacer les valeurs
        $entity->getUser()->setAddress($addressTab[0]['formatted_address']);
        $entity->getUser()->setUnacurateAddress($addressTab[1]['formatted_address']);
        $entity->getUser()->setLatitude($latitude);
        $entity->getUser()->setLongitude($longitude);
        foreach ($addressTab[0]['address_components'] as $component)
        {
            if ($component['types'][0] == "postal_code") $entity->getUser()->setPostCode($component['short_name']);
            if ($component['types'][0] == "locality") $entity->getUser()->setCity($component['short_name']);
        }

        $this->updateTrustpoints($entity);

        // Persist in DB
        $em->persist($entity);
        $em->flush();

        $response['success'] = true;
        //$response['message'] = $request->request->get('value');

        // Response
        return new JsonResponse( $response );
    }

    /**
     * Upload a presentation video.
     * AJAX
     *
     */
    public function videoUploadAJAXAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        if (!$user) {
            die('Veuillez vous reconnecter s\'il vous plait');
        }

        $entity = $user->getBabysitter();

        if (!$entity) {
            die('Seules les nounous peuvent télécharger des vidéos.');
        }

        if(isset($_FILES["videoUploadfile"]) && $_FILES["videoUploadfile"]["error"]== UPLOAD_ERR_OK)
        {
            ############ Edit settings ##############
            $UploadDirectory    = __DIR__.'/../../../../web/uploads/babysitters/'; //specify upload directory ends with / (slash)
            ##########################################

            /*
            Note : You will run into errors or blank page if "memory_limit" or "upload_max_filesize" is set to low in "php.ini".
            Open "php.ini" file, and search for "memory_limit" or "upload_max_filesize" limit
            and set them adequately, also check "post_max_size".
            */

            //check if this is an ajax request
            /*if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
                die();
            }*/


            //Is file size is less than allowed size.
            if ($_FILES["videoUploadfile"]["size"] > 104857600) {
                die("File size is too big!");
            }

            //allowed file type Server side check
            switch(strtolower($_FILES['videoUploadfile']['type']))
            {
                //allowed file types
                case 'video/mp4':
                case 'video/webm':
                case 'video/ogg':
                    break;
                default:
                    die('Unsupported File!'); //output error
            }

            $File_Name          = strtolower($_FILES['videoUploadfile']['name']);
            $File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
            $Random_Number      = rand(0, 999999999); //Random number to be added to name.
            $NewFileName        = $Random_Number.$File_Ext; //new file name

            if(!move_uploaded_file($_FILES['videoUploadfile']['tmp_name'], $UploadDirectory.$NewFileName ))
            {
                die('error uploading File!');
            }

            $entity->setVideo($NewFileName);

            $this->updateTrustpoints($entity);

            // Persist in DB
            $em->persist($entity);
            $em->flush();

            // Response
            $response['success'] = true;
            $response['videoUrl'] = $entity->getVideo();
            return new JsonResponse( $response );

        }
        else
        {
            die('Something wrong with upload!');
        }
    }

    private function updateTrustpoints(Babysitter $user)
    {
        $values = array(
            'profile' => array(
                'firstname' => $this->container->getparameter('trustpoints.profile.firstname'),
                'lastname' => $this->container->getparameter('trustpoints.profile.lastname'),
                'birthdate' => $this->container->getparameter('trustpoints.profile.birthdate'),
                'postcode' => $this->container->getparameter('trustpoints.profile.postcode'),
                'city' => $this->container->getparameter('trustpoints.profile.city'),
                'address' => $this->container->getparameter('trustpoints.profile.address'),
                'phone' => $this->container->getparameter('trustpoints.profile.phone'),
                'avatar' => $this->container->getparameter('trustpoints.profile.avatar'),
            ),
            'babysitter' => array(
                'children' => $this->container->getparameter('trustpoints.babysitter.children'),
                'favoriteActivity' => $this->container->getparameter('trustpoints.babysitter.favoriteActivity'),
                'languages' => $this->container->getparameter('trustpoints.babysitter.languages'),
                'hobbies' => $this->container->getparameter('trustpoints.babysitter.hobbies'),
                'smoke' => $this->container->getparameter('trustpoints.babysitter.smoke'),
                'presentation' => $this->container->getparameter('trustpoints.babysitter.presentation'),
                'diplomas' => $this->container->getparameter('trustpoints.babysitter.diplomas'),
                'category' => $this->container->getparameter('trustpoints.babysitter.category'),
                'ageOfChildren' => $this->container->getparameter('trustpoints.babysitter.ageOfChildren'),
                'calendar' => $this->container->getparameter('trustpoints.babysitter.calendar'),
                'priceRate' => $this->container->getparameter('trustpoints.babysitter.priceRate'),
            ),
        );

        return $user->computeTrustpoints($values);
    }
}
