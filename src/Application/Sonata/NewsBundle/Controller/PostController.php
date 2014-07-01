<?php

namespace Application\Sonata\NewsBundle\Controller;


use Sonata\NewsBundle\Model\PostInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class PostController extends \Sonata\NewsBundle\Controller\PostController
{

    /**
     * @param $post
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getCommentForm(PostInterface $post)
    {
        $user = $this->getUser();
        $comment = $this->getCommentManager()->create();
        $comment->setPost($post);
        $comment->setAuthor($user);
        $comment->setName($user->getFirstname());
        $comment->setStatus($post->getCommentsDefaultStatus());

        return $this->get('form.factory')->createNamed('comment', 'application_sonata_post_comment', $comment);
    }

    /**
     * @throws NotFoundHttpException
     *
     * @param string $id
     *
     * @return Response
     */
    public function addCommentAction($id)
    {
        $post = $this->getPostManager()->findOneBy(array(
            'id' => $id
        ));
        $user = $this->getUser();

        if (!$post) {
            throw new NotFoundHttpException(sprintf('Post (%d) not found', $id));
        }

        if (!$post->isCommentable()) {
            // todo add notice
            return new RedirectResponse($this->generateUrl('application_sonata_news_view', array(
                'permalink'  => $this->getBlog()->getPermalinkGenerator()->generate($post)
            )));
        }

        $form = $this->getCommentForm($post);
        $form->bind($this->get('request'));

        if ($form->isValid()) {
            $comment = $form->getData();

            $comment->setAuthor($user);

            $this->getCommentManager()->save($comment);
            $this->get('sonata.news.mailer')->sendCommentNotification($comment);

            // todo : add notice
            return new RedirectResponse($this->generateUrl('sonata_news_view', array(
                'permalink'  => $this->getBlog()->getPermalinkGenerator()->generate($post)
            )));
        }

        return $this->render('SonataNewsBundle:Post:view.html.twig', array(
            'post' => $post,
            'form' => $form
        ));
    }
}
