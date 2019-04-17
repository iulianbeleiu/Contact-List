<?php
/**
 * Created by PhpStorm.
 * User: iulianbeleiu
 * Date: 2019-04-14
 * Time: 19:55
 */

namespace AppBundle\Controller;


use AppBundle\Form\ContactType;
use AppBundle\Services\UploaderHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class ContactController extends Controller
{
    /**
     * @Route("/", name="contact_list")
     */
    public function contactListAction()
    {
        $contacts = [];
        try {
            $contacts = $this->getDoctrine()
                ->getRepository(Contact::class)
                ->findAll();
        } catch (\Exception $exception) {
            $this->addFlash('error', 'Could not get the contacts.');
        }

        return $this->render('contact/list.html.twig', [
            'contacts' => $contacts,
            'pictureBasePath' => UploaderHelper::PICTURE_UPLOAD_PATH
        ]);
    }

    /**
     * @Route("/contact/edit/{id}", name="contact_edit")
     * @param Request $request
     * @param $id
     * @param UploaderHelper $fileUploader
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function contactEditAction(Request $request, $id, UploaderHelper $fileUploader)
    {
        try {
            $contact = $this->getDoctrine()
                ->getRepository(Contact::class)
                ->find($id);
        } catch (\Exception $exception) {
            $this->addFlash('error', 'Could not get the requested contact.');
            return $this->redirectToRoute('contact_list');
        }

        if (!$contact) {
            $this->addFlash('error', 'Contact not found.');
            return $this->redirectToRoute('contact_list');
        }

        // populate edit form with contact data
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $contact = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($contact);
                $entityManager->flush();

                /** @var UploadedFile $picture */
                $picture = $form['pictureFile']->getData();
                if ($picture) {
                    $pictureName = $fileUploader->uploadFile($picture);

                    // add the image only if the upload is successful
                    // and contact was edited successfully
                    $contact->setPicture($pictureName);
                    $entityManager->flush();
                }

                $this->addFlash('success', 'Contact updated.');
            } catch (UploadException $uploadException) {
                $this->addFlash('warning', $uploadException->getMessage());
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Unable to process picture upload.');
            }
        }

        return $this->render('contact/add_edit.html.twig', [
            'contactForm' => $form->createView(),
            'pictureBasePath' => UploaderHelper::PICTURE_UPLOAD_PATH
        ]);
    }

    /**
     * @Route("/contact/add", name="contact_add")
     * @param Request $request
     * @param UploaderHelper $fileUploader
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function contactAddAction(Request $request, UploaderHelper $fileUploader)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $contact = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($contact);
                $entityManager->flush();

                /** @var UploadedFile $picture */
                $picture = $form['pictureFile']->getData();
                if ($picture) {
                    $pictureName = $fileUploader->uploadFile($picture);

                    // add the image only if the upload is successful
                    // and contact was added successfully
                    $contact->setPicture($pictureName);
                    $entityManager->flush();
                }

                $this->addFlash('success', 'Contact added.');
            } catch (UploadException $uploadException) {
                $this->addFlash('warning', 'Picture Upload failed.');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Unable to process picture upload.');
            }

            return $this->redirectToRoute('contact_list');
        }

        return $this->render('contact/add_edit.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/contact/delete/{id}", name="contact_delete")
     */
    public function contactDeleteAction($id)
    {
        try {
            $entityManager = $this->getDoctrine()->getManager();

            $contact = $this->getDoctrine()
                ->getRepository(Contact::class)
                ->find($id);

            $entityManager->remove($contact);
            $entityManager->flush();

            $this->addFlash('success', 'Contact deleted.');
        } catch (\Exception $exception) {
            $this->addFlash('error', 'Contact could not be deleted');
        }

        return $this->redirectToRoute('contact_list');
    }
}