<?php

namespace Pn\PnBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pn\PnBundle\Entity\Babysitter;
use Pn\PnBundle\Form\BabysitterType;
use Symfony\Component\HttpFoundation\JsonResponse;


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

        $entities = $em->getRepository('PnPnBundle:Babysitter')->findAll();

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
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Babysitter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Babysitter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $calendarStr = str_split($entity->getCalendar(),1);

        $calendar = array_fill(1, 24 ,array_fill(1, 7, false));

        $i = 1;
        $j = 1;
        foreach ($calendarStr as &$c)
        {
            if ($c == ')')
            {
                $j = 1;
                $i++;
                continue;
            }
            if ($c == '0')
            {
                $j++;
            }
            if ($c == '1')
            {
                $calendar[$i][$j] = true;
                $j++;
            }
        }

        return $this->render('PnPnBundle:Babysitter:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'calendarMatrix' => $calendar,
            'id' => $id
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
                $m = $birthdate->format('m');
                $Y = $birthdate->format('Y');

                $birthdate->setDate($Y , $m , $value);
                $user->setBirthdate($birthdate);
                break;
            case 'birthdate_month':
                $birthdate = $user->getBirthdate();
                $d = $birthdate->format('d');
                $Y = $birthdate->format('Y');

                $birthdate->setDate($Y , $value , $d);
                $user->setBirthdate($birthdate);
                break;
            case 'birthdate_year':
                $birthdate = $user->getBirthdate();
                $d = $birthdate->format('d');
                $m = $birthdate->format('m');

                $birthdate->setDate($value , $m , $d);
                $user->setBirthdate($birthdate);
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
            default:
                $response['success'] = false;
                $response['message'] = 'wrong parameter';
                return new JsonResponse( $response );
        }

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
        $calendar = $calendarService->getMatrix($entity->getCalendar());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Babysitter entity.');
        }

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
        $x = explode("-", $id)[0];
        $y = explode("-", $id)[1];

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
