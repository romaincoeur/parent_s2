<?php

namespace Pn\PnBundle\Controller;

use Pn\PnBundle\Entity\Recommendation;
use Pn\PnBundle\Form\RecommendationType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pn\PnBundle\Entity\Job;
use Pn\PnBundle\Form\JobType;

/**
 * Job controller.
 *
 */
class JobController extends Controller
{

    /**
     * Lists all Job entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PnPnBundle:Job')->findAll();

        return $this->render('PnPnBundle:Job:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Lists all Job entities.
     *
     */
    public function annoncesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PnPnBundle:Job')->findByStatus('annonce');

        return $this->render('PnPnBundle:Job:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Lists Job entities.
     *
     */
    public function searchAction($search)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PnPnBundle:Job')->getFromSearch($search);

        return $this->render('PnPnBundle:Job:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Job entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Job();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        /*if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setParent($this->getUser()->getParent());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pn_job_show', array('id' => $entity->getId())));
        }*/

        $calendar = array_fill(1, 24 ,array_fill(1, 7, false));
        return $this->render('PnPnBundle:Job:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'calendarMatrix' => $calendar
        ));
    }

    /**
    * Creates a form to create a Job entity.
    *
    * @param Job $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Job $entity)
    {
        $form = $this->createForm(new JobType(), $entity, array(
            'action' => $this->generateUrl('pn_job_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Job entity.
     *
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Job();

        // gestion du calendrier
        $calendarService = $this->container->get('pn.calendar');
        $entity->setCalendar($calendarService->newString());

        $entity->setParent($this->getUser()->getParent());
        $em->persist($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('pn_job_edit', array('id' => $entity->getId())));
    }

    /**
     * Finds and displays a Job entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Job')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Job entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        // gestion du calendrier
        $calendarService = $this->container->get('pn.calendar');
        $calendar = $calendarService->getMatrix($entity->getCalendar());

        // Configure the recommendation form
        $form = $this->createForm(new RecommendationType(), new Recommendation(), array(
            'action' => $this->generateUrl('recommendation_send',array('to' => $id)),
            'method' => 'POST',
        ));

        return $this->render('PnPnBundle:Job:show.html.twig', array(
            'entity'      => $entity,
            'calendarMatrix' => $calendar,
            'recommendation_form' => $form->createView()
        ));
    }

    /**
     * Displays a form to edit the current job of the current user.
     *
     */
    public function editAction()
    {
        $user = $this->getUser();
        if (!$user) {
            throw $this->createNotFoundException('Vous devez être connecté pour accéeder à cette fonctionalité');
        }
        if ($user->getType() != 'parent') {
            throw $this->createNotFoundException('Seuls les parents peuvent creer des annonces.');
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $user->getParent()->getCurrentJob();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Job entity.');
        }

        $editForm = $this->createEditForm($entity);

        // gestion du calendrier
        $calendarService = $this->container->get('pn.calendar');
        $calendar = $calendarService->getMatrix($entity->getCalendar());

        return $this->render('PnPnBundle:Job:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'calendarMatrix' => $calendar
        ));
    }

    /**
    * Creates a form to edit a Job entity.
    *
    * @param Job $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Job $entity)
    {
        $form = $this->createForm(new JobType(), $entity, array(
            'action' => $this->generateUrl('pn_job_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Job entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Job')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Job entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pn_job_edit', array('id' => $id)));
        }

        return $this->render('PnPnBundle:Job:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Job entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PnPnBundle:Job')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Job entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pn_job'));
    }

    /**
     * Creates a form to delete a Job entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pn_job_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * Edits the address from Google Geocoder.
     * AJAX
     *
     */
    public function updateAddressAJAXAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Job')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Job entity.');
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
        $entity->setAddress($addressTab[0]['formatted_address']);
        $entity->setUnacurateAddress($addressTab[1]['formatted_address']);
        $entity->setLatitude($latitude);
        $entity->setLongitude($longitude);
        foreach ($addressTab[0]['address_components'] as $component)
        {
            if ($component['types'][0] == "postal_code") $entity->setPostCode($component['short_name']);
            if ($component['types'][0] == "locality") $entity->setCity($component['short_name']);
        }

        // Persist in DB
        $em->persist($entity);
        $em->flush();

        $response['success'] = true;
        //$response['message'] = $request->request->get('value');

        // Response
        return new JsonResponse( $response );
    }

    /**
     * Edits an existing Babysitter entity.
     * AJAX
     *
     */
    public function updateFieldAJAXAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Job')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Job entity.');
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
            case 'title':
                $entity->setTitle($value);
                break;
            case 'rate_price':
                $entity->setRatePrice($value);
                break;
            case 'rate_type':
                $entity->setRateType($value);
                break;
            case 'description':
                $entity->setDescription($value);
                break;
            case 'phone':
                $entity->setPhone($value);
                break;
            case 'address':
                $entity->setAddress($value);
                break;
            case 'latitude':
                $entity->setLatitude($value);
                break;
            case 'longitude':
                $entity->setLongitude($value);
                break;
            case 'start_day':
                $start = $entity->getStart();
                $d = $value;
                $m = $start->format('m');
                $Y = $start->format('Y');

                $entity->setStart(new \DateTime($Y.'-'.$m.'-'.$d));
                break;
            case 'start_month':
                $start = $entity->getStart();
                $d = $start->format('d');
                $m = $value;
                $Y = $start->format('Y');

                $entity->setStart(new \DateTime($Y.'-'.$m.'-'.$d));
                break;
            case 'start_year':
                $start = $entity->getStart();
                $d = $start->format('d');
                $m = $start->format('m');
                $Y = $value;

                $entity->setStart(new \DateTime($Y.'-'.$m.'-'.$d));
                break;
            case 'end_day':
                $end = $entity->getEnd();
                $d = $value;
                $m = $end->format('m');
                $Y = $end->format('Y');

                $entity->setEnd(new \DateTime($Y.'-'.$m.'-'.$d));
                break;
            case 'end_month':
                $end = $entity->getEnd();
                $d = $end->format('d');
                $m = $value;
                $Y = $end->format('Y');

                $entity->setEnd(new \DateTime($Y.'-'.$m.'-'.$d));
                break;
            case 'end_year':
                $end = $entity->getEnd();
                $d = $end->format('d');
                $m = $end->format('m');
                $Y = $value;

                $entity->setEnd(new \DateTime($Y.'-'.$m.'-'.$d));
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

        // Persist in DB
        $em->persist($entity);
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

        $entity = $em->getRepository('PnPnBundle:Job')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Job entity.');
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

        // Persist in DB
        $em->persist($entity);
        $em->flush();

        $response['success'] = true;
        $response['id'] = $id;

        // Response
        return new JsonResponse( $response );
    }
}
