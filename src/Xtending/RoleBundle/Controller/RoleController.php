<?php

namespace Xtending\RoleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Xtending\EntityBundle\Entity\Role;
use Xtending\RoleBundle\Form\RoleType;
use Xtending\RoleBundle\Services\RoleServices;

/**
 * Controlador Role.
 *
 */
class RoleController extends Controller
{
	protected $roleServices;
	
	public function __construct()
	{
		$this->roleServices = new RoleServices($this);
	}
	
	/**
	 * Lista todos las entidades de Role.
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
    public function indexAction()
    {
        
        $roles = $this->roleServices->getAllRoles();
		return $this->render('RoleBundle:Role:index.html.twig', array(
            'entities' => $roles,
        ));
    }
    
    /**
     * Crea una nueva entidad Role.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $role  = new Role();
        $form = $this->createForm(new RoleType(), $role);
        $form->bind($request);

        if ($form->isValid()) {
        	
            $em = $this->getDoctrine()->getManager();
            $em->persist($role);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_role'));
        }

        return $this->render('RoleBundle:Role:new.html.twig', array(
            'entity' => $role,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Muestra el formulario para crear la nueva entidad.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction()
    {
        $role = new Role();
        $form   = $this->createForm(new RoleType(), $role);

        return $this->render('RoleBundle:Role:new.html.twig', array(
            'entity' => $role,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Busca y muestra una entidad Role.
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $role = $this->roleServices->getRole($id);

        if (!$role) {
            throw $this->createNotFoundException('Unable to find Role entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RoleBundle:Role:show.html.twig', array(
            'entity'      => $role,
            'delete_form' => $deleteForm->createView(),
        	));
    }

    /**
     * Muestra un formulario para editar una entidad existente de Role.
     * @param unknown $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id)
    {
        $role = $this->roleServices->getRole($id);

        if (!$role) {
            throw $this->createNotFoundException('Unable to find Role entity.');
        }

        $editForm = $this->createForm(new RoleType(), $role);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RoleBundle:Role:edit.html.twig', array(
            'entity'      => $role,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edita una entidad de Role existente.
     * @param Request $request
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, $id)
    {
    	
    	
    	$role = $this->roleServices->getRole($id);

        if (!$role) {
            throw $this->createNotFoundException('Unable to find Role entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new RoleType(), $role);
        $editForm->bind($request);

        if ($editForm->isValid()) {
        	$em = $this->getDoctrine()->getManager();
            $em->persist($role);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_role_edit', array('id' => $id)));
        }

        return $this->render('RoleBundle:Role:edit.html.twig', array(
            'entity'      => $role,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Elimina una entidad de Role.
     * @param Request $request
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            
            $role = $this->roleServices->getRole($id);

            if (!$role) {
                throw $this->createNotFoundException('Unable to find Role entity.');
            }

            $em = $this->getDoctrine()->getManager();
            $em->remove($role);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_role'));
    }

    /**
     * Crea un formulario para eliminar una entidad Role por ID.
     * @param mixed $id El id de la entidad
     * @return \Symfony\Component\Form\Form el formulario
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
