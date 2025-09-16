<?php
class Pagination{

    public $totalItem;					// Tổng số phần tử
    public $totalItemPerPage	= 4;	// Tổng số phần tử trên 1 trang
    public $pageRange			= 3;	// Số trang hiển thị
    public $currentPage		    = 1;	// Trang hiện tại
    public $totalPage;					// Tổng số trang

	// Thiết lập tổng số phần tử trên một trang
	public function setTotalItemPerPage($number){
		if(is_int($number)) {
			$this->totalItemPerPage = $number;
		}
		return this;
	}

	// Thiết lập số trang hiển thị
	public function setPageRange($number){
		if(is_int($number)) {
			$this->pageRange = $number;
		}
		return $this;
	}

	// $pagination lấy từ Controller - $pagination = array($totalItemsPerPage, $pageRange, $currentPage)
	public function __construct($totalItem, $pagination){
		$this->totalItem 			= $totalItem;
		$this->totalItemPerPage 	= $pagination['totalItemsPerPage'];

		if($pagination['pageRange'] % 2 == 0) {
            $pagination['pageRange'] = $pagination['pageRange'] + 1;
        }

		$this->pageRange 			= $pagination['pageRange'];
		$this->currentPage 			= $pagination['currentPage'];
		$this->totalPage 			= ceil($this->totalItem/$pagination['totalItemsPerPage']);
	}

	public function showPaginator($link){
	    // Pagination
        $paginationXML = '';
        if($this->totalItem  > 1){
			$startPage	= '<div class="button2-right off">
                                <div class="start"><span>Start</span></div>
                           </div>';
			$prevPage	= '<div class="button2-right off">
                                <div class="prev"><span>Previous</span></div>
                           </div>';
			$nextPage 	= '<div class="button2-left off">
                                <div class="next"><span>Next</span></div>
                           </div>';
			$endPage 	= '<div class="button2-left off">
                                <div class="end"><span>End</span></div>
                           </div>';

			if($this->currentPage > 1){
				$startPage	= '<div class="button2-right">
                                    <div class="start"><a onclick="javascript:changePage(1)" href="#">Start</a></div>
                               </div>';
				$prevPage	= '<div class="button2-right">
                                    <div class="prev"><a onclick="javascript:changePage('.($this->currentPage-1).')" href="#">Previous</a></div>
                               </div>';
			}

            // Next
            if($this->currentPage < $this->totalPage ){
                $nextPage	= '<div class="button2-left">
                                    <div class="next"><a onclick="javascript:changePage('.($this->currentPage+1).')" href="#">Next</a></div>
                               </div>';
                $endPage	= '<div class="button2-left">
                                    <div class="next"><a onclick="javascript:changePage('.($this->totalPage).')" href="#">End</a></div>
                               </div>';
            }

			if($this->pageRange >= $this->totalPage ){
				$start = 1;
				$end	= $this->totalPage ;
			}else{
				if($this->currentPage==1){
					$start 	= 1;
					$end	= $this->pageRange;
				}else if($this->currentPage==$this->totalPage ){
					$start 	= $this->totalPage -$this->pageRange+1;
					$end	= $this->totalPage ;
				}else{
					$start 	= max(array($this->currentPage-($this->pageRange-1)/2, 1));
					$end 	= min(array($this->currentPage+($this->pageRange-1)/2, $this->totalPage ));
				}
			}

            $listPages = '<div class="button2-left"><div class="page">';
			for($i = $start; $i <= $end; $i++) {
				if($i == $this->currentPage){
                    $listPages	.= '<span>'.$i.'</span>';
				} else{
                    $listPages	.= '<a onclick="javascript:changePage('.$i.')" href="#">'.$i.'</a>';
				}
			}
            $listPages .= '</div></div>';
            $endPagination = '<div class="limit text-center">Page '.$this->currentPage.' of '.$this->totalPage.'</div>';

			$paginationXML	= '<div class="pagination">'.$startPage.$prevPage.$listPages.$nextPage.$endPage.'</div>' . $endPagination;
		}
		return $paginationXML;
	}

}