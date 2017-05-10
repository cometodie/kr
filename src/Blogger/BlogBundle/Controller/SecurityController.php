<?php

namespace Blogger\BlogBundle\Controller;
use Blogger\BlogBundle\Entity\Role;
use Blogger\BlogBundle\Entity\User;
use Blogger\BlogBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\Security;

class SecurityController extends Controller{
    public function loginAction(Request $request){
        if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
            $error = $$request->attributes->get(Security::AUTHENTICATION_ERROR);
        } else {
            $error = $request->getSession()->get(Security::AUTHENTICATION_ERROR);
        }


        return $this->render('BloggerBlogBundle:Security:login.html.twig', array(
            'last_username' => $request->getSession()->get(Security::LAST_USERNAME),
            'error' => $error
        ));
    }

    public function regAction(Request $request){

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            if ($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $role = $em->getRepository("BloggerBlogBundle:Role")->getRole("ROLE_USER")[0];
                $user->addUserRole($role);
                $user->setSalt(md5(time()));

                // шифрует и устанавливает пароль для пользователя,
                // эти настройки совпадают с конфигурационными файлами
                $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
                $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
                $user->setPassword($password);

                $em->persist($user);
                $em->flush();
            }

            return $this->render("BloggerBlogBundle:Security:login.html.twig", array(
                "last_user" => $user
            ));
        }

        return $this->render("@BloggerBlog/Security/form_reg.html.twig", array(
            "form" => $form->createView()
        ));
    }
}