<?php namespace App\Transformers;

use App\Models\Faq;

class FaqTransformer extends ParentTransformer{

    public $key = 'faqs';

    function br2nl($string) {
	    return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
	} 
    public function transform(Faq $faq){

        $faqArray = [
            'id' => (int)$faq->id,
            'question' => $faq->question,
            'answer'=> $this->br2nl($faq['answer']),
            'category_id'=> $faq->category_id,
            'category_name_ar'=> $faq->category ? $faq->category->name : '' ,
            'category_name_en'=> $faq->category ? $faq->category->name_en : '' ,
            'category'=> $faq->category ? $faq->category : null,
            'sort'=> $faq->sort,
            'lang'=> $faq->lang,
            'status'=> $faq->status,
            'created_at'=> $faq->created_at,
            'updated_at'=> $faq->updated_at,
        ];

        return $faqArray;
    }

}