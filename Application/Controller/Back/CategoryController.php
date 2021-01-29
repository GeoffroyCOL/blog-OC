<?php
namespace Application\Controller\Back;

use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\AbstractController;
use Application\Service\CategoryService;
use Framework\Error\NotFoundEntityException;
use Application\Form\Category\AddCategoryType;
use Application\Form\Category\EditCategoryType;

class CategoryController extends AbstractController
{
    private Request $request;

    public function __construct()
    {
        parent::__construct();

        $this->request = new Request;
        $this->categoryService = new CategoryService;
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

        return $this->render('back/category/listCategories.php', [
            'categories' => $this->categoryService->getAll()
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
            $this->addFlash("succes", "La catégorie a bien été ajoutée.");
            $this->redirection('/admin/categories');
        }

        return $this->render('back/category/addCategory.php', [
            'form' => $form->createView()
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
                $this->addFlash("succes", "La catégorie '{$category->getName()}' a bien été modifiée.");
                $this->redirection('/admin/categories');
            }
        } catch (NotFoundEntityException $e) {
            $messageError = $e->getMessage();
        }

        return $this->render('back/category/editCategory.php', [
            'form'         => isset($form) ? $form->createView() : null,
            'messageError' => $messageError ?? ''
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
            $this->addFlash("succes", "La catégorie '{$category->getName()}' a bien été supprimée.");
        } catch (NotFoundEntityException $e) {
            $messageError = $e->getMessage();
        }
        $this->redirection('/admin/categories');
    }
}
