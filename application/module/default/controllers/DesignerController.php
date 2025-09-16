<?php
class DesignerController extends Controller
{

    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
        $this->_templateOBJ->setFolderTemplate('default/main/');
        $this->_templateOBJ->setFileTemplate('index.php');
        $this->_templateOBJ->setFileConfig('template.ini');
        $this->_templateOBJ->load();
    }

    public function indexAction()
    {
        $this->_view->Items = $this->_model->listItems($this->_arrayParam, null);
        $this->_view->_title = 'Meet Our Designers';
        $this->_view->render('designer/index');
    }

    public function productAction(){
        $totalItems                 = $this->_model->countItems($this->_arrayParam, null);
        $this->_view->allItems      = $this->_model->countItems($this->_arrayParam, null);
        $this->_view->nameProduct   = $this->_model->listItems($this->_arrayParam, array('task' => 'get-name-product'));

        $configPagination           = array(
            'totalItemsPerPage' => 15,
            'pageRange'         => 5
        );
        $this->setPagination($configPagination);
        $this->_view->pagination    = new Pagination($totalItems, $this->_pagination);

        $this->_view->designerName  = $this->_model->infoItems($this->_arrayParam, array('task' => 'get-designer-name'));


        $this->_view->_title 		= 'Designs by ' . $this->_view->designerName[$this->_arrayParam['designer_id']];
        $this->_view->Items 		= $this->_model->listItems($this->_arrayParam, array('task' => 'product-in-designer'));

        // Nếu không tồn tại cate_name trong CSDL, redirect về Home
        if(!isset($this->_view->designerName)) {
            URL::redirect('default', 'index', 'index');
        }
        $this->_view->render('designer/product');
    }

    public function infoAction()
    {
        $this->_view->DesignerInfo = $this->_model->infoItems($this->_arrayParam, array('task' => 'designer-info'));
        $this->_view->_title = 'Furniture by ' . $this->_view->DesignerInfo['name'];
        $this->_view->render('designer/info');
    }
}
