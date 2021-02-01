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
            throw new NotFoundException("Pas de catégories pour la page demandée", 404);
        }

        $categories = $this->categoryService->getAll(($page - 1), $numberPostPerPage);

        if (empty($categories)) {
            $this->addFlash('info', "Pour la page {$page}, pas d'article à afficher.");
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
     * @return void
     */
    public function addCategory()
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
     * @return void
     */
    public function editCategory($ident)
    {
        try {
            $this->isAccess('admin');

            $category = $this->categoryService->getCategory($ident);
            $form = $this->createForm(EditCategoryType::class, $category);

            if ($this->request->method() === 'POST' && $form->isValid()) {
                $this->categoryService->edit($form->getData());
                $this->addFlash("success", "La catégorie '{$category->getName()}' a bien été modifiée.");
                $this->redirection('/admin/categories');
            }
        } catch (NotFoundEntityException $e) {
            $this->addFlash("danger", $e->getMessage());
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
     * @param  mixed $ident
     * @return Response
     */
    public function deleteCategory($ident): Response
    {
        try {
            $this->isAccess('admin');

            if ($ident == 1) {
                throw new NotFoundEntityException("Vous ne pouvez pas modifier cette catégorie", 403);
            }

            $category = $this->categoryService->getCategory($ident);
            $this->categoryService->delete($category);
            $this->addFlash("success", "La catégorie '{$category->getName()}' a bien été supprimée.");
        } catch (NotFoundEntityException $e) {
            $this->addFlash("success", $e->getMessage());
        } finally {
            $this->redirection('/admin/categories');
        }
    }
}
