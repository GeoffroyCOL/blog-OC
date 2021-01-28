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
        $form = $this->createForm(AddCategoryType::class);

        if ($this->request->method() === 'POST' && $form->isValid()) {
            $this->categoryService->add($form->getData());
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
            $category = $this->categoryService->getCategory($ident);
            $form = $this->createForm(EditCategoryType::class, $category);

            if ($this->request->method() === 'POST' && $form->isValid()) {
                $this->categoryService->edit($form->getData());
                $this->redirection('/admin/categories');
            }
        } catch(NotFoundEntityException $e) {
            $messageError = $e->getMessage();
        }

        return $this->render('back/category/editCategory.php', [
            'form'         => isset($form) ? $form->createView() : null,
            'messageError' => $messageError ?? ''
        ]);
    }
}