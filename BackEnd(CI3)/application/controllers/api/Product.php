<?php

/* Table structure for table `products` */
// CREATE TABLE `products` (
//   `id` int(10) UNSIGNED NOT NULL,
//   `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
//   `price` double NOT NULL,
//   `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
//   `updated_at` datetime DEFAULT NULL
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
// ALTER TABLE `products` ADD PRIMARY KEY (`id`);
// ALTER TABLE `products` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1; COMMIT;

/**
 * Product class.
 * 
 * @extends REST_Controller
 */
   require APPPATH . '/libraries/REST_Controller.php';
   use Restserver\Libraries\REST_Controller;
     
class Product extends REST_Controller {
    
	  /**
     * CONSTRUCTOR | LOAD MODEL
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->library('Authorization_Token');	
       $this->load->model('Product_model');
    }
       
    /**
     * SHOW | GET method.
     *
     * @return Response
    */
	public function index_get($id = 0)
	{
        // ------- Main Logic part -------
        if(!empty($id)){
            $data = $this->Product_model->show($id);
            if($data==null){
                $response_data = [
                    "message" => "Data Not Found",
                    "data" => "null"
                ];
                $this->response($response_data, REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $data = $this->Product_model->show();
        }
        $response_data = [
            "message" => "Success getting data product",
            "data" => $data
        ];
        $this->response($response_data, REST_Controller::HTTP_OK);
        // ------------- End -------------
	}
      
    /**
     * INSERT | POST method.
     *
     * @return Response
    */
    public function index_post()
    {
        $data = $this->_post_args;

        // Load library form validation
        $this->load->library('form_validation');
        
        // Atur aturan validasi untuk setiap input
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('product_code', 'Kode Product', 'required');
        $this->form_validation->set_rules('category_id', 'Category ID', 'numeric');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');
        $this->form_validation->set_rules('description', 'Description', 'required');

        // ------- Main Logic part -------
        // Jalankan validasi
        if ($this->form_validation->run() === TRUE) {
            $input = $this->input->post();
            $data = $this->Product_model->insert($input);
            $response_data = [
                "message" => "Success creating data product",
                "data" => $input
            ];
            $this->response($response_data, REST_Controller::HTTP_OK);
        } else {
            // Jika validasi gagal, kirim pesan kesalahan validasi
            $this->response(['Validation errors' => $this->form_validation->error_array()], REST_Controller::HTTP_BAD_REQUEST);
        }
        // ------------- End -------------
    } 
     
    /**
     * UPDATE | PUT method.
     *
     * @return Response
    */
    public function index_put($id)
    {
        // // ------- Main Logic part -------
        $input = $this->_put_args;

        $headers = $this->input->request_headers(); 
        $data['product_name'] = $input['product_name'];
        $data['category_id'] = $input['category_id'];
        $data['price'] = $input['price'];
        $data['quantity'] = $input['quantity'];
        $data['description'] = $input['description'];
        $data['product_code'] = $input['product_code'];
        $response = $this->Product_model->update($data, $id);

        $response_data = [
            "message" => "Success updating data product",
            "data" => $input
        ];

        $response>0?$this->response($response_data, REST_Controller::HTTP_OK):$this->response(['Not updated'], REST_Controller::HTTP_NOT_FOUND);
        // // ------------- End -------------
    }
     
    /**
     * DELETE method.
     *
     * @return Response
    */
    public function index_delete($id)
    {
        // ------- Main Logic part -------
        $response = $this->Product_model->delete($id);

        $response_data = [
            "message" => "Success deleting data product",
            "id" => $id
        ];

        $response>0?$this->response($response_data, REST_Controller::HTTP_OK):$this->response(['Not deleted'], REST_Controller::HTTP_NOT_FOUND);
        // ------------- End -------------
    }
    	
}