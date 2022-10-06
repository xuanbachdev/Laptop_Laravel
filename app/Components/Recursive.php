<?php
    namespace App\Components;

    class Recursive
    {
        private $data;
        private $htmlSelect = '';

        public function __construct($data)
        {
            $this->data = $data;
        }

        public function Recursive($parent_id, $id = 0, $char = '')
        {
            foreach ($this->data as $key => $item){
               // Nếu là chuyên mục con thì hiển thị
                if($item['parent_id'] == $id)
                {
                    // Xóa chuyên mục đã lặp
                    unset($this->data[$key]);

                    if(!empty($parent_id) && $parent_id == $item['id'])
                    {
                        $this->htmlSelect .= '<option value="'.$item['id'].'" selected>'.$char.$item['name'].'</option>';
                    }
                    else{
                        $this->htmlSelect .= '<option value="'.$item['id'].'" >'.$char.$item['name'].'</option>';
                    }
                    // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                    $this->Recursive($parent_id ,$item['id'], $char.str_repeat('&nbsp;', 3));
                }
            }
            return $this->htmlSelect;
        }
    }
