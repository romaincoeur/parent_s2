<?php

namespace Pn\PnBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pn\PnBundle\Entity\User;
use Pn\PnBundle\Form\UserType;

/**
 * User controller.
 *
 */
class UserController extends Controller
{

    /**
     * Lists all User entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PnPnBundle:User')->findAll();

        return $this->render('PnPnBundle:User:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new User entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new User();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getId())));
        }

        return $this->render('PnPnBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a User entity.
     *
     * @param User $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(User $entity)
    {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('user_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new User entity.
     *
     */
    public function newAction()
    {
        $entity = new User();
        $form   = $this->createCreateForm($entity);

        return $this->render('PnPnBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PnPnBundle:User:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PnPnBundle:User:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a User entity.
     *
     * @param User $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(User $entity)
    {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('user_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing User entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('user_edit', array('id' => $id)));
        }

        return $this->render('PnPnBundle:User:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PnPnBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user'));
    }

    /**
     * Creates a form to delete a User entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }

    /**
     * Upload a new avatar picture
     * AJAX
     *
     */
    public function avatarUploadAJAXAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        if (!$user) {
            $response['success'] = false;
            $response['message'] = 'Veuillez vous reconnecter s\'il vous plait';
            return new JsonResponse( $response );
        }

        if(isset($_POST))
        {
            ############ Edit settings ##############
            $DestinationDirectory	= __DIR__.'/../../../../web/uploads/users/'; //specify upload directory ends with / (slash)
            $Quality 				= 90; //jpeg quality
            ##########################################

            $x = $request->request->get('x');
            $y = $request->request->get('y');
            $w = $request->request->get('w');
            $h = $request->request->get('h');


            // check $_FILES['ImageFile'] not empty
            if(!isset($_FILES['uploadfile']) || !is_uploaded_file($_FILES['uploadfile']['tmp_name']))
            {
                die('Quelque chose s\'est mal passé. Veuillez réessayer s\'il vous plait'); // output error when above checks fail.
            }

            // Random number will be added after image name
            $RandomNumber 	= rand(0, 99999);

            $ImageName 		= str_replace(' ','-',strtolower($_FILES['uploadfile']['name'])); //get image name
            $ImageSize 		= $_FILES['uploadfile']['size']; // get original image size
            $TempSrc	 	= $_FILES['uploadfile']['tmp_name']; // Temp name of image file stored in PHP tmp folder
            $ImageType	 	= $_FILES['uploadfile']['type']; //get file type, returns "image/png", image/jpeg, text/plain etc.

            //Let's check allowed $ImageType, we use PHP SWITCH statement here
            switch(strtolower($ImageType))
            {
                case 'image/png':
                    //Create a new image from file
                    $CreatedImage =  imagecreatefrompng($_FILES['uploadfile']['tmp_name']);
                    break;
                case 'image/gif':
                    $CreatedImage =  imagecreatefromgif($_FILES['uploadfile']['tmp_name']);
                    break;
                case 'image/jpeg':
                case 'image/pjpeg':
                    $CreatedImage = imagecreatefromjpeg($_FILES['uploadfile']['tmp_name']);
                    break;
                default:
                    die('Unsupported File!'); //output error and exit
            }

            //PHP getimagesize() function returns height/width from image file stored in PHP tmp folder.
            //Get first two values from image, width and height.
            //list assign svalues to $CurWidth,$CurHeight
            list($CurWidth,$CurHeight) = getimagesize($TempSrc);

            //Get file extension from Image name, this will be added after random name
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.','',$ImageExt);

            //remove extension from filename
            $ImageName = preg_replace("/\\.[^.\\s]{3,4}$/", "", $ImageName);

            //Construct a new name with random number and extension.
            $NewImageName = $ImageName.'-'.$RandomNumber.'.'.$ImageExt;

            //set the Destination Image
            $DestRandImageName = $DestinationDirectory.$NewImageName; // Image with destination directory

            // Crop and save image to upload directory
            $cropService = $this->container->get('pn.crop');
            if(!$cropService->cropImage($x,$y,$w,$h,$DestRandImageName,$CreatedImage,$Quality,$ImageType))
            {
                die('Erreur lors du rognage de l\'image');
            }


            // Insert info into database table
            $user->setAvatar($NewImageName);
            $em->persist($user);
            $em->flush();
        }

        $response['success'] = true;
        $response['imgUrl'] = $user->getAvatar();

        // Response
        return new JsonResponse( $response );
    }
}
