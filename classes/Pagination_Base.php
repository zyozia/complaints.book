<?php
/**
 * @category pagination
 * @author skhomych
 */
class Pagination_Base
{    
    /**
     * Поточна сторінка
     * 
     * @var int 
     */
    private $_page;
    
    /**
     * Всього записів
     * 
     * @var int 
     */
    private $_pages;
    
    /**
     * GET
     * 
     * @var str
     */
    private $_get;
    /**
     * Кількість пагінацій
     * 
     * @var int
     */
    private $_listPage;
    
    private $_limit;
    /** 
     * @param   int $cou - кількість записів потрібно вивести
     * @param   int $page - поточна сторінка
     * @param   int $pages - всього записів в таблиці
     * @param   str $get - Гет
     * @param   int $listPage - кількість пагінацій котру потрібно відобразити
     * @return  void
     */
    
    public function __construct($cou, $pages, $get = '', $listPage = 20)
    {
        empty($_GET['page'])?$page=1:$page = (int)$_GET['page'];
        $this->_limit = ((int)$page*(int)$cou-(int)$cou).','.$cou;
        $this->_page = $page;
        $this->_pages = ceil((int)$pages/(int)$cou);
        $this->_get = $get;
        $this->_listPage = $listPage;
    }
    
    /**
     * підставляємо в sql запит в limit 
     * 
     * return string '0,5'
     */
    public function getLimit() 
    {
        return $this->_limit;
    }
    
    /*
     * return str Пагінація
     */
    
    public function getPaginator() 
    {
        $paginator = '';
		$paginator .= '<nav><ul class="pagination">' ;
        if ($this->_page > $this->_listPage+1) $paginator .= ' <li><a href="?'.$this->_get.'page=1"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li> ';
        for ($i = ($this->_page - $this->_listPage); $i < ($this->_page + $this->_listPage+1); $i++) {
                if ($i > 0 AND $i < $this->_pages+1) {
                    if ($i == ($this->_page )) $alink = '<li class="active"> <a>'.$i.'</a> </li>';
                    else $alink = ' <li><a href="?'.$this->_get.'page='.$i.'">'.$i.'</a> </li>';
                        $paginator .= $alink;
                    }
                }
        if ($this->_page < $this->_pages-$this->_listPage) $paginator .= ' <li><a href="?'.$this->_get.'page='.$this->_pages.'"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li> ';
		$paginator .= '</ul></nav>';
        return $paginator;
    }
    
}
