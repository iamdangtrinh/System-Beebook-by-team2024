<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UserAdmin extends Component
{
    use WithPagination;

    public $getAllUser = [];
    public $phone = '';
    public $email = '';
    public $idUser = '';
    public $paginationData;
    public $isModal = false;

    public function mount()
    {
        $this->loadUsers();
    }

    // Load users với phân trang, có thể áp dụng bộ lọc
    public function loadUsers()
    {
        $query = User::query();

        if (!empty($this->idUser)) {
            $query->where('id', 'like', '%' . $this->idUser . '%');
        }
        if (!empty($this->email)) {
            $query->where('email', 'like', '%' . $this->email . '%');
        }
        if (!empty($this->phone)) {
            $query->where('phone', 'like', '%' . $this->phone . '%');
        }

        // Thực hiện phân trang
        $paginator = $query->paginate(20);
        $this->getAllUser = $paginator->items();
        $this->updatePaginationData($paginator);
    }

    public function updatePaginationData($paginator)
    {
        $this->paginationData = [
            'currentPage' => $paginator->currentPage(),
            'lastPage' => $paginator->lastPage(),
            'total' => $paginator->total(),
            'perPage' => $paginator->perPage(),
        ];
    }

    public function updatedIdUser($value)
    {
        $this->idUser = $value;
        $this->resetPage(); // Quay về trang đầu
        $this->loadUsers();
    }

    public function updatedEmail($value)
    {
        $this->email = $value;
        $this->resetPage(); // Quay về trang đầu
        $this->loadUsers();
    }

    public function updatedPhone($value)
    {
        $this->phone = $value;
        $this->resetPage(); // Quay về trang đầu
        $this->loadUsers();
    }

    public function previousPage()
    {
        if ($this->paginationData['currentPage'] > 1) {
            $this->gotoPage($this->paginationData['currentPage'] - 1);
        }
    }

    public function nextPage()
    {
        if ($this->paginationData['currentPage'] < $this->paginationData['lastPage']) {
            $this->gotoPage($this->paginationData['currentPage'] + 1);
        }
    }

    public function gotoPage($page)
    {
        $this->setPage($page);
        $this->loadUsers(); // Cập nhật danh sách user theo trang hiện tại và bộ lọc
    }
    public function closeModal()
    {
        $this->isModal = !$this->isModal;
    }
    public function render()
    {
        return view('livewire.user-admin');
    }
}