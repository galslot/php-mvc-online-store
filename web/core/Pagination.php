<?php

namespace core;

class Pagination
{
    public int $currentPage;
    public int $countItemsOnPage;
    public int $total;
    public int $countPages;
    public string $uri;

    public function __construct($page, $total, $countItemsOnPage)
    {
        $this->countItemsOnPage = $countItemsOnPage;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri = $this->getParams();
    }

    public function getHtmlNavigation(): string
    {
        $back = null;
        $forward = null;
        $startPage = null;
        $endPage = null;
        $page2left = null;  # 2-й страница слева
        $page1left = null;  # 1-й страница слева
        $page2right = null; # 2-й страница справа
        $page1right = null; # 1-й страница справа

        if ($this->currentPage > 1) {
            $back = "<li class='page-item'><a class='page-link' href='".
                $this->getLink($this->currentPage - 1).
                "'>&lt;</a></li>";
        }

        if ($this->currentPage < $this->countPages) {
            $forward = "<li class='page-item'><a class='page-link' href='".
                $this->getLink($this->currentPage + 1).
                "'>&gt;</a></li>";
        }

        if ($this->currentPage > 3) {
            $startPage = "<li class='page-item'><a class='page-link' href='".
                $this->getLink(1).
                "'>&laquo;</a></li>";
        }

        if ($this->currentPage < ($this->countPages - 2)) {
            $endPage = "<li class='page-item'><a class='page-link' href='".
                $this->getLink($this->countPages).
                "'>&raquo;</a></li>";
        }

        if ($this->currentPage - 2 > 0) {
            $page2left = "<li class='page-item'><a class='page-link' href='".
                $this->getLink($this->currentPage - 2).
                "'>".($this->currentPage - 2)."</a></li>";
        }

        if ($this->currentPage - 1 > 0) {
            $page1left = "<li class='page-item'><a class='page-link' href='".
                $this->getLink($this->currentPage - 1).
                "'>".($this->currentPage - 1)."</a></li>";
        }

        if ($this->currentPage + 1 <= $this->countPages) {
            $page1right = "<li class='page-item'><a class='page-link' href='".
                $this->getLink($this->currentPage + 1).
                "'>".($this->currentPage + 1)."</a></li>";
        }

        if ($this->currentPage + 2 <= $this->countPages) {
            $page2right = "<li class='page-item'><a class='page-link' href='".$this->getLink(
                    $this->currentPage + 2
                ).
                "'>".($this->currentPage + 2)."</a></li>";
        }

        $html = '<nav aria-label="Page navigation"><ul class="pagination">';
        $html .= $startPage.$back.$page2left.$page1left;
        $html .= '<li class="page-item active"><a class="page-link">';
        $html .= $this->currentPage.'</a></li>'.$page1right.$page2right.$forward.$endPage.'</ul></nav>';

        return $html;
    }

    public function getLink($page): string
    {
        if ($page == 1) return rtrim($this->uri, '?&');

        if (str_contains($this->uri, '&')) {
            return "{$this->uri}page={$page}";
        }

        if (str_contains($this->uri, '?')) {
            return "{$this->uri}page={$page}";
        }
        return "{$this->uri}?page={$page}";
    }

    public function __toString()
    {
        return $this->getHtmlNavigation();
    }

    public function getCountPages(): int
    {
        return ceil($this->total / $this->countItemsOnPage) ?: 1;
    }

    public function getCurrentPage($page): int
    {
        if (!$page || $page < 1) $page = 1;
        if ($page > $this->countPages) $page = $this->countPages;
        return $page;
    }

    public function getStart(): int
    {
        $limit = ($this->currentPage - 1) * $this->countItemsOnPage;
        return $limit;
    }

    public function getParams(): string
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = $url[0];
        if (isset($url[1]) && $url[1] != '') {
            $uri .= '?';
            $params = explode('&', $url[1]);
            foreach ($params as $param) {
                if (!preg_match("#page=#", $param)) $uri .= "{$param}&";
            }
        }
        return $uri;
    }

}