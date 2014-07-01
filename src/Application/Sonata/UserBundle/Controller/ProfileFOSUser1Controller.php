<?php


namespace Application\Sonata\UserBundle\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class ProfileFOSUser1Controller extends \Sonata\UserBundle\Controller\ProfileFOSUser1Controller
{
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
            $DestinationDirectory	= __DIR__.'/../../../../../web/uploads/users/'; //specify upload directory ends with / (slash)
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
