<?php
class CommentController extends Controller {
    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
        $this->_templateOBJ->setFolderTemplate('admin/main/');
        $this->_templateOBJ->setFileTemplate('index.php');
        $this->_templateOBJ->setFileConfig('template.ini');
        $this->_templateOBJ->load();
    }

    // Action:  List Comment
    public function indexAction(){
        $this->_view->_title 		= 'Comment';
        $totalItems                 = $this->_model->countItems($this->_arrayParam, null);
        $configPagination           = array(
            'totalItemsPerPage' => 10,
            'pageRange'         => 3
        );
        $this->setPagination($configPagination);
        $this->_view->pagination    = new Pagination($totalItems, $this->_pagination);
        $this->_view->Items 		= $this->_model->listItems($this->_arrayParam, null);
        $this->_view->render('comment/index');
    }

    // Action: Ajax Status
    public function ajaxStatusAction(){
        $result = $this->_model->changeStatus($this->_arrayParam, array('task' => 'change-ajax-status'));
        echo json_encode($result);
    }

    // Action: Status
    public function statusAction(){
        $this->_model->changeStatus($this->_arrayParam, array('task' => 'change-status'));
        URL::redirect('admin', 'comment', 'index');

    }

    // Action: Trash
    public function trashAction(){
        $this->_model->deleteItem($this->_arrayParam);
        URL::redirect('admin', 'comment', 'index');
    }
}
