<?php
namespace Application\Controller\Back;

use Framework\Pagination;
use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\AbstractController;
use Framework\Error\NotFoundException;
use Application\Service\CategoryService;
use Framework\Error\NotFoundEntityException;
use Application\Form\Category\AddCategoryType;
use Application\Form\Category\EditCategoryType;

class CategoryController extends AbstractController
{
    private Request $request;
    private CategoryService $categoryService;
    private Pagination $pagination;

    public function __construct()
    {
        parent::__construct();

        $this->request = new Request;
        $this->categoryService = new CategoryService;
        $this->pagination = new Pagination;
    }

    /**
     * listCategory
     *
     * @Route(path="/admin/categories", name="categories")
     *
     * @return Response
     */
    public function listCategory(): Response
    {
        $this->isAccess('admin');
        $numberPostPerPage = 10;

        $page = $this->request->getExists('page') ? $this->request->getData('page') : 1;
        if ($page < 1) {
            $this->addFlash('info', "Pas de categories à afficher.");
            $this->redirection('/admin/categories');
        }

        $categories = $this->categoryService->getAll(($page - 1), $numberPostPerPage);
        if (empty($categories)) {
            $this->addFlash('info', "Pour la page {$page}, pas de categories à afficher.");
            $this->redirection('/admin/categories');
        }

        $this->pagination->setParams($numberPostPerPage, $page, $this->categoryService->numberPost(), '/admin/categories');

        return $this->render('back/category/listCategories.php', [
            'categories'        => $categories,
            'pageMenu'          => 'categories',
            'pagination'        => $this->pagination->generateHTML(),
            'numeroPage'        => $page,
            'numberPostPerPage' => $numberPostPerPage,
        ]);
    }
    
    /**
     * addCategory
     *
     * @Route(path="/admin/category/add", name="add.category")
     *
     * @return Response
     */
    public function addCategory(): Response
    {
        $this->isAccess('admin');

        $form = $this->createForm(AddCategoryType::class);
        if ($this->request->method() === 'POST' && $form->isValid()) {
            $this->categoryService->add($form->getData());
            $this->addFlash("success", "La catégorie a bien été ajoutée.");
            $this->redirection('/admin/categories');
        }

        return $this->render('back/category/addCategory.php', [
            'form'          => $form->createView(),
            'pageMenu'      => 'categories',
            'formErrors'    => $form->getAllErrors()
        ]);
    }

    /**
     * editCategory
     *
     * @Route(path="/admin/category/edit/{id}", name="edit.category", requirement="[0-9]")
     *
     * @param  int $ident
     * @return Response
     */
    public function editCategory($ident): Response
    {
        try {
            $this->isAccess('admin');

            if ($ident == 1) {
                $this->addFlash("info", "Vous ne pouvez pas modifier cette catégorie.");
                $this->redirection('/admin/categories');
            }


            $category = $this->categoryService->getCategory($ident);

            $form = $this->createForm(EditCategoryType::class, $category);
            if ($this->request->method() === 'POST' && $form->isValid()) {
                $this->categoryService->edit($form->getData());
                $this->addFlash("success", "La catégorie '{$category->getName()}' a bien été modifiée.");
                $this->redirection('/admin/categories');
            }
        } catch (NotFoundException $e) {
            $this->addFlash("error", $e->getMessage());
            $this->redirection('/admin/categories');
        }

        return $this->render('back/category/editCategory.php', [
            'form'           => $form->createView(),
            'pageMenu'      => 'categories',
            'formErrors'    => $form->getAllErrors()
        ]);
    }
    
    /**
     * deleteCategory
     *
     * @Route(path="/admin/category/delete/{id}", name="delete.category", requirement="[0-9]")
     *
     * @param  int $ident
     * @return Response
     */
    public function deleteCategory($ident): Response
    {
        try {
            $this->isAccess('admin');

            if ($ident == 1) {
                $this->addFlash("info", "Vous ne pouvez pas supprimer cette catégorie.");
                $this->redirection('/admin/categories');
            }

            $category = $this->categoryService->getCategory($ident);
            $this->categoryService->delete($category);
            $this->addFlash("success", "La catégorie '{$category->getName()}' a bien été supprimée.");
        } catch (NotFoundException $e) {
            $this->addFlash("error", $e->getMessage());
        } finally {
            $this->redirection('/admin/categories');
        }
    }
}

//HQD93jPpa9kpAaw