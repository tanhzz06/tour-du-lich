<?php
require_once './models/CustomerModel.php';
require_once './commons/function.php'; // chứa connectDB()

class CustomerController
{

    protected $model;

    public function __construct()
    {
        $db = connectDB();            
        $this->model = new CustomerModel($db);   
    }

    /* ============================
        Danh sách khách hàng
       ============================ */
    public function list()
    {
        $customers = $this->model->getAllCustomers();
        include './views/admin/customer/customer-list.php';
    }

    /* ============================
        Form thêm khách hàng
       ============================ */
    public function create()
    {
        include './views/admin/customer/customer-create.php';
    }

    /* ============================
        Lưu khách hàng mới
       ============================ */
    public function store()
    {
        $this->model->addCustomer(
            $_POST['full_name'],
            $_POST['email'],
            $_POST['phone'],
            $_POST['address'],
            $_POST['status']
        );

        header("Location: index.php?act=customer-list");
        exit;
    }
    /* ============================
       Chi tiết khách hàng 
       ============================ */
    public function detail()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header("Location: index.php?act=customer-list");
            exit;
        }

        $customer = $this->model->getCustomerById($id);
        $bookings = $this->model->getCustomerBookings($id);

        include './views/admin/customer/customer-detail.php';
    }


    /* ============================
        Form sửa khách hàng
       ============================ */
    public function edit()
    {
        $id = $_GET['id'];
        $customer = $this->model->getCustomerById($id);
        include './views/admin/customer/customer-edit.php';
    }

    /* ============================
        Cập nhật khách hàng
       ============================ */
    public function update()
    {
        $this->model->updateCustomer(
            $_POST['customer_id'],
            $_POST['full_name'],
            $_POST['email'],
            $_POST['phone'],
            $_POST['address'],
            $_POST['status']
        );

        header("Location: index.php?act=customer-list");
        exit;
    }

    /* ============================
        Xóa khách hàng
       ============================ */
    public function delete()
    {
        $id = $_GET['id'];
        $this->model->deleteCustomer($id);

        header("Location: index.php?act=customer-list");
        exit;
    }
}
