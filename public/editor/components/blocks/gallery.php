<?php

namespace LPCandy\Components;

class Gallery extends Block {
    public $name;
    public $description;
    public $editor = "lp.gallery";
    
    function __construct() { 
        if (self::$en) {
            $this->name = 'Gallery';
            $this->description = "Photos and images";
        } else {
            $this->name = 'Галерея';
            $this->description = "Фотографии работ";
        }        
    }
    
    function tpl($val) {?>		
        <div class="container-fluid gallery gallery_1" style="background: <?=$val['background']?>;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <? if ($cls = $this->vis($val['show_title'])): ?>
                            <h1 class="title <?=$cls?> " >
                                <? $this->sub('Text','title',Text::$plain_heading) ?>
                            </h1>
                        <? endif ?>
                        <? if ($cls = $this->vis($val['show_title_2'])): ?>
                            <div class="title_2 <?=$cls?> " >
                                <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                            </div>
                        <? endif ?>
                        <? (!$val['show_image_title'] && !$val['show_image_desc']) ? $opacity ='no_opacity': $opacity ='' ?>
                        <div class="item_list <?=$opacity?>"> 
                            <? $this->repeat('items', function($item_val,$self) use ($val) { ?>							
                                <div class="preview_img" style="background-image: url('<?=$this->api->base_url."/".$item_val['image']?>');"></div>
                                    <? if ($cls = $self->vis($val['enable_fancybox'])): ?>
                                        <a class="fancybox big_img <?=$cls?>" href="<?=$this->api->base_url."/".$item_val['image']?>" title="<?=$item_val['title']?>"></a>
                                    <? endif ?>
                                <div class="overlay">
                                    <div class="wrap_title_desc">
                                        <? if ($cls = $self->vis($val['show_image_title'])): ?>
                                            <div class="img_title <?=$cls?>" >
                                                <?= $item_val['title'] ?>
                                            </div>
                                        <? endif ?>
                                        <? if ($cls = $self->vis($val['show_image_desc'])): ?>
                                            <div class="img_desc <?=$cls?>" >
                                                <?= $item_val['desc'] ?>
                                            </div>
                                        <? endif ?>
                                    </div>
                                </div>                           	
                            <? },array('editor' => 'lp.galleryRepeater'));?> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
            'show_image_title' => true,
            'show_image_desc' => true,
            'enable_fancybox' => true,
            'background' =>'#FFFFFF',
            'title' => "Our program in photos",
            'title_2' => "Subtitle",
            'items' => array(
                array( 'image' => Configuration::$assets_url."/gallery/21.jpg", 'title' => 'Three people put the hats on', 'desc' => 'Acrobats on the ropes' ),
                array( 'image' => Configuration::$assets_url."/gallery/24.jpg", 'title' => 'Tusk', 'desc' => 'Trained rhino' ),
                array( 'image' => Configuration::$assets_url."/gallery/25.jpg", 'title' => 'Jumper', 'desc' => 'Show with the horse' ),
                array( 'image' => Configuration::$assets_url."/gallery/26.jpg", 'title' => 'Lambada', 'desc' => 'Dancing elephants' ),
                array( 'image' => Configuration::$assets_url."/gallery/27.jpg", 'title' => 'Tigress', 'desc' => 'It is the one on the left' ),
                array( 'image' => Configuration::$assets_url."/gallery/30.jpg", 'title' => 'Grace', 'desc' => 'Girl on the tape' ),            
            )
        ] : [
            'show_title' => true,
            'show_title_2' => false,
            'show_image_title' => true,
            'show_image_desc' => true,
            'enable_fancybox' => true,
            'background' =>'#FFFFFF',
            'title' => "Наша программа в фотографиях",
            'title_2' => "Подзаголовок",
            'items' => array(
                array( 'image' => Configuration::$assets_url."/gallery/21.jpg", 'title' => 'Трое в шляпах', 'desc' => 'Акробаты на канатах' ),
                array( 'image' => Configuration::$assets_url."/gallery/24.jpg", 'title' => 'Бивень', 'desc' => 'Дрессированный носорог' ),
                array( 'image' => Configuration::$assets_url."/gallery/25.jpg", 'title' => 'Прыгун', 'desc' => 'Номер с конём' ),
                array( 'image' => Configuration::$assets_url."/gallery/26.jpg", 'title' => 'Ламбада', 'desc' => 'Танцующие слоны' ),
                array( 'image' => Configuration::$assets_url."/gallery/27.jpg", 'title' => 'Тигрица', 'desc' => 'Это та, что слева' ),
                array( 'image' => Configuration::$assets_url."/gallery/30.jpg", 'title' => 'Грация', 'desc' => 'Девушка на лентах' ),            
            )
        ];
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid gallery gallery_2" style="background: <?=$val['background']?>;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <? if ($cls = $this->vis($val['show_title'])): ?>
                            <h1 class="title <?=$cls?> " >
                                <? $this->sub('Text','title',Text::$plain_heading) ?>
                            </h1>
                        <? endif ?>
                        <? if ($cls = $this->vis($val['show_title_2'])): ?>
                            <div class="title_2 <?=$cls?> " >
                                <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                            </div>
                        <? endif ?>
                        <div class="item_list <?= !$val['show_image_desc'] ? "hide_desc" : "" ?> <?= !$val['show_image_overlay'] ? "hide_overlay" : "" ?>">
                            <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                                <div class="row">
                                    <? for ($i=1; $i <= 2; $i++): ?>
                                        <div class="col-6">
                                            <div class="item">
                                                <?=$self->sub('GalleryImage','image_'.$i)?>
                                                <div class="overlay">
                                                    <div class="in">                                        
                                                        <div class="img_title">
                                                            <? $self->sub('Text','img_title_'.$i,Text::$plain_heading) ?>
                                                        </div>
                                                        <? if ($cls = $self->vis($val['show_image_desc'])): ?>
                                                            <div class="img_desc <?=$cls?>" >
                                                                <? $self->sub('Text','img_desc_'.$i,Text::$color_heading) ?>
                                                            </div>
                                                        <? endif ?>
                                                        <div class="img_text">
                                                            <? $self->sub('Text','img_text_'.$i,Text::$default_text) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <? endfor ?>
                                </div>
                            <? }) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_2() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_overlay' => true,
            'background' => '#FFFFFF',
            'title' => "Our Prima",
			'title_2' => "Subtilte",
            'items' => array(
                array(
                    'image_1' => array('image'=> Configuration::$assets_url.'/gallery/1.jpg'),
                    'img_title_1' => "In ring",
                    'img_desc_1' => "Fascinating spectacle",
                    'img_text_1' => "Additional description of the picture. Brevity - the sister of talent.",
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/2.jpg'),
                    'img_title_2' => "Entrance",                    
                    'img_desc_2' => "At the entrance she meets",
                    'img_text_2' => "Additional description of the picture. Brevity - the sister of talent.",
                ),
                array(
                    'image_1' => array('image'=> Configuration::$assets_url.'/gallery/5.jpg'),
                    'img_title_1' => "Form №2",
                    'img_desc_1' => "Nude torso",
                    'img_text_1' => "Additional description of the picture. Brevity - the sister of talent.",
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/6.jpg'),
                    'img_title_2' => "Prima and clown",
                    'img_desc_2' => "Foci",
                    'img_text_2' => "Additional description of the picture. Brevity - the sister of talent.",
                )
            )
        ] : [
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_overlay' => true,
            'background' => '#FFFFFF',
            'title' => "Наша Прима",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'image_1' => array('image'=> Configuration::$assets_url.'/gallery/1.jpg'),
                    'img_title_1' => "В кольце",
                    'img_desc_1' => "Завораживающее зрелище",
                    'img_text_1' => "Дополнительное описание картинки. Краткость - сестра таланта.",
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/2.jpg'),
                    'img_title_2' => "У входа",                    
                    'img_desc_2' => "На входе встречает она",
                    'img_text_2' => "Дополнительное описание картинки. Краткость - сестра таланта.",
                ),
                array(
                    'image_1' => array('image'=> Configuration::$assets_url.'/gallery/5.jpg'),
                    'img_title_1' => "Форма №2",
                    'img_desc_1' => "Голый торс",
                    'img_text_1' => "Дополнительное описание картинки. Краткость - сестра таланта.",
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/6.jpg'),
                    'img_title_2' => "Прима и клоун",
                    'img_desc_2' => "Номер с фокусами",
                    'img_text_2' => "Дополнительное описание картинки. Краткость - сестра таланта.",
                )
            )
        ];
    }
    
    function tpl_3($val) {?>
        <div class="container-fluid gallery gallery_3" style="background: <?=$val['background']?>;">
           <div class="container">
                <div class="row">
                    <div class="col-12">
                        <? if ($cls = $this->vis($val['show_title'])): ?>
                            <h1 class="title <?=$cls?> " >
                                <? $this->sub('Text','title',Text::$plain_heading) ?>
                            </h1>
                        <? endif ?>
                        <? if ($cls = $this->vis($val['show_title_2'])): ?>
                            <div class="title_2 <?=$cls?> " >
                                <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                            </div>
                        <? endif ?>
                        <div class="item_list">
                            <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                                <div class="row">
                                    <? for ($i=1; $i <= 3; $i++): ?>        
                                        <div class="col-4">       
                                            <div class="item">								
                                                <? $self->sub('GalleryImage','image_'.$i) ?>
                                                <? if ($cls = $self->vis($val['show_image_overlay'])): ?>
                                                    <div class="overlay <?=$cls?>" >
                                                        <div class="img_title">
                                                            <? $self->sub('Text','img_title_'.$i,Text::$plain_heading) ?>
                                                        </div>
                                                        <? if ($cls = $self->vis($val['show_image_desc'])): ?>
                                                            <div class="img_desc <?=$cls?>" >
                                                                <? $self->sub('Text','img_desc_'.$i,Text::$default_text) ?>
                                                            </div>
                                                        <? endif ?>
                                                    </div>
                                                <? endif ?>
                                            </div>
                                        </div>
                                    <? endfor ?>
                                </div>
                            <? }) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_3() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_overlay' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Good girl",
			'title_2' => "Subtitle",
            'items' => array(
                array(
                    'image_1' => array('image'=> Configuration::$assets_url.'/gallery/1.jpg'),
                    'img_title_1' => "In ring",
                    'img_desc_1' => "Fascinating spectacle",
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/2.jpg'),
                    'img_title_2' => "Entrance",                    
                    'img_desc_2' => "At the entrance she meets",
                    'image_3' => array('image'=> Configuration::$assets_url.'/gallery/3.jpg'),
                    'img_title_3' => "Throwing knives",
                    'img_desc_3' => "Dangerous stunts with knives",
                ),
                array(
                    'image_1' => array('image'=> Configuration::$assets_url.'/gallery/5.jpg'),
                    'img_title_1' => "Form №2",
                    'img_desc_1' => "Nude torso",
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/6.jpg'),
                    'img_title_2' => "Prima and clown",
                    'img_desc_2' => "Foci",
                    'image_3' => array('image'=> Configuration::$assets_url.'/gallery/7.jpg'),
                    'img_title_3' => "Long legs",
                    'img_desc_3' => "16 and up",
                )
            )
        ] : [
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_overlay' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Просто хорошая девушка",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'image_1' => array('image'=> Configuration::$assets_url.'/gallery/1.jpg'),
                    'img_title_1' => "В кольце",
                    'img_desc_1' => "Завораживающее зрелище",
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/2.jpg'),                   
                    'img_title_2' => "У входа",
                    'img_desc_2' => "На входе встречает она",
                    'image_3' => array('image'=> Configuration::$assets_url.'/gallery/3.jpg'),
                    'img_title_3' => "Метание ножей",
                    'img_desc_3' => "Опасный трюк с ножами",
                ),
                array(
                    'image_1' => array('image'=> Configuration::$assets_url.'/gallery/5.jpg'),
                    'img_title_1' => "Форма №2",
                    'img_desc_1' => "Голый торс",
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/6.jpg'),                   
                    'img_title_2' => "Прима и клоун",
                    'img_desc_2' => "Номер с фокусами",
                    'image_3' => array('image'=> Configuration::$assets_url.'/gallery/7.jpg'),
                    'img_title_3' => "Ноги от ушей",
                    'img_desc_3' => "От 16 и старше",
                )
            )
        ];
    }
    
    function tpl_4($val) {?>
        <div class="container-fluid gallery gallery_4" style="background: <?=$val['background']?>;">
           <div class="container">
                <div class="row">
                    <div class="col-12">
                        <? if ($cls = $this->vis($val['show_title'])): ?>
                            <h1 class="title <?=$cls?> " >
                                <? $this->sub('Text','title',Text::$plain_heading) ?>
                            </h1>
                        <? endif ?>
                        <? if ($cls = $this->vis($val['show_title_2'])): ?>
                            <div class="title_2 <?=$cls?> " >
                                <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                            </div>
                        <? endif ?>
                        <div class="item_list clear">
                            <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                                <div class="row">
                                    <? for ($i=1; $i <= 4; $i++): ?>
                                        <div class="col-3">                         
                                            <div class="item">								
                                                <? $self->sub('GalleryImage','image_'.$i) ?>
                                                <? if ($cls = $self->vis($val['show_image_overlay'])): ?>
                                                    <div class="overlay <?=$cls?>" >
                                                        <div class="img_title">
                                                            <? $self->sub('Text','img_title_'.$i,Text::$plain_heading) ?>
                                                        </div>
                                                        <? if ($cls = $self->vis($val['show_image_desc'])): ?>
                                                            <div class="img_desc <?=$cls?>" >
                                                                <? $self->sub('Text','img_desc_'.$i,Text::$default_text) ?>
                                                            </div>
                                                        <? endif ?>
                                                    </div>
                                                <? endif ?>
                                            </div>
                                        </div>
                                    <? endfor ?>
                                </div>
                            <? }) ?>                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_4() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_overlay' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Graceful beauty",
			'title_2' => "Subtitle",
            'items' => array(
                array(
                    'image_1' => array('image'=> Configuration::$assets_url.'/gallery/1.jpg'),
                    'img_title_1' => "In ring",
                    'img_desc_1' => "Fascinating spectacle",
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/2.jpg'),
                    'img_title_2' => "Entrance",                    
                    'img_desc_2' => "At the entrance she meets",
                    'image_3' => array('image'=> Configuration::$assets_url.'/gallery/3.jpg'),
                    'img_title_3' => "Throwing knives",
                    'img_desc_3' => "Dangerous stunts with knives",
					'image_4' => array('image'=> Configuration::$assets_url.'/gallery/4.jpg'),                   
                    'img_title_4' => "Ticketing",
                    'img_desc_4' => "At the box office again Prima",
                ),
                array(
                    'image_1' => array('image'=> Configuration::$assets_url.'/gallery/5.jpg'),
                    'img_title_1' => "Form №2",
                    'img_desc_1' => "Nude torso",
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/6.jpg'),
                    'img_title_2' => "Prima and clown",
                    'img_desc_2' => "Foci",
                    'image_3' => array('image'=> Configuration::$assets_url.'/gallery/7.jpg'),
                    'img_title_3' => "Long legs",
                    'img_desc_3' => "16 and up",
					'image_4' => array('image'=> Configuration::$assets_url.'/gallery/8.jpg'),
                    'img_title_4' => "In the dressing room",
                    'img_desc_4' => "Before going on stage",
                )
            )
        ] : [
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_overlay' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Изящная чертовка",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'image_1' => array('image'=> Configuration::$assets_url.'/gallery/1.jpg'),
                    'img_title_1' => "В кольце",
                    'img_desc_1' => "Завораживающее зрелище",
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/2.jpg'),                   
                    'img_title_2' => "У входа",
                    'img_desc_2' => "На входе встречает она",
                    'image_3' => array('image'=> Configuration::$assets_url.'/gallery/3.jpg'),
                    'img_title_3' => "Метание ножей",
                    'img_desc_3' => "Опасный трюк с ножами",
					'image_4' => array('image'=> Configuration::$assets_url.'/gallery/4.jpg'),                   
                    'img_title_4' => "Обилечивание",
                    'img_desc_4' => "У кассы снова Прима",
                ),
                array(
                    'image_1' => array('image'=> Configuration::$assets_url.'/gallery/5.jpg'),                   
                    'img_title_1' => "Форма №2",
                    'img_desc_1' => "Голый торс",
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/6.jpg'),                   
                    'img_title_2' => "Прима и клоун",
                    'img_desc_2' => "Номер с фокусами",
                    'image_3' => array('image'=> Configuration::$assets_url.'/gallery/7.jpg'),                   
                    'img_title_3' => "Ноги от ушей",
                    'img_desc_3' => "От 16 и старше",
					'image_4' => array('image'=> Configuration::$assets_url.'/gallery/8.jpg'),
                    'img_title_4' => "В гримёрке",
                    'img_desc_4' => "Перед выходом на сцену",
                )
            )
        ];
    }
    
    
    function tpl_5($val) {?>
        <div class="container-fluid gallery gallery_5" style="background: <?=$val['background']?>;">           
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <? if ($cls = $this->vis($val['show_title'])): ?>
                            <h1 class="title <?=$cls?> " >
                                <? $this->sub('Text','title',Text::$plain_heading) ?>
                            </h1>
                        <? endif ?>
                        <? if ($cls = $this->vis($val['show_title_2'])): ?>
                            <div class="title_2 <?=$cls?> " >
                                <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                            </div>
                        <? endif ?>
                        <? (!$val['show_image_title'] && !$val['show_image_desc']) ? $opacity ='no_opacity': $opacity ='' ?>
                        <div class="item_list <?=$opacity?>">
                            <div class="slider">
                                <? $this->repeat('items', function($item_val,$self) use ($val){ ?>                                
                                    <div class="preview_img">									
                                        <img src="<?=$self->api->base_url."/".$item_val['image']?>">
                                        <? if ($cls = $self->vis($val['enable_fancybox'])): ?>
                                            <a class="fancybox big_img <?=$cls?>" href="<?=$self->api->base_url."/".$item_val['image']?>" title="<?=$item_val['title']?>"></a>
                                        <? endif ?>                                        
                                    </div>                                    
                                    <div class="overlay">
                                        <div class="wrap_title_desc">
                                            <? if ($cls = $self->vis($val['show_image_title'])): ?>
                                                <div class="img_title <?=$cls?>" >
                                                    <?= $item_val['title'] ?>
                                                </div>
                                            <? endif ?>
                                            <? if ($cls = $self->vis($val['show_image_desc'])): ?>
                                                <div class="img_desc <?=$cls?>" >
                                                    <?= $item_val['desc'] ?>
                                                </div>
                                            <? endif ?>
                                        </div>
                                    </div>                                
                                <? },array('editor'=>'lp.galleryRepeater','sortable'=>false));?>											
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_5() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
            'show_image_title' => true,
            'show_image_desc' => true,
			'enable_fancybox' => true,
            'background' => '#F7F7F7',
            'title' => "Lovely",
            'title_2' => "Subtitle",
            'items' => array(
                array( 'image' => Configuration::$assets_url."/gallery/1.jpg", 'title' => 'In ring', 'desc' => 'Fascinating spectacle' ),
                array( 'image' => Configuration::$assets_url."/gallery/2.jpg", 'title' => 'Entrance', 'desc' => 'At the entrance she meets' ),
                array( 'image' => Configuration::$assets_url."/gallery/3.jpg", 'title' => 'Throwing knives', 'desc' => 'Dangerous stunts with knives' ),
                array( 'image' => Configuration::$assets_url."/gallery/4.jpg", 'title' => 'Ticketing', 'desc' => 'At the box office again Prima' ),
                array( 'image' => Configuration::$assets_url."/gallery/5.jpg", 'title' => 'Form №2', 'desc' => 'Nude torso' ),
                array( 'image' => Configuration::$assets_url."/gallery/6.jpg", 'title' => 'Prima and clown', 'desc' => 'Foci' ),  
                array( 'image' => Configuration::$assets_url."/gallery/7.jpg", 'title' => 'Long legs', 'desc' => '16 and up' ),
                array( 'image' => Configuration::$assets_url."/gallery/8.jpg", 'title' => 'In the dressing room', 'desc' => 'Before going on stage' ),
                array( 'image' => Configuration::$assets_url."/gallery/9.jpg", 'title' => 'Swing', 'desc' => 'Prima under the dome' ), 
            )
        ] : [
            'show_title' => true,
            'show_title_2' => false,
            'show_image_title' => true,
            'show_image_desc' => true,
			'enable_fancybox' => true,
            'background' => '#F7F7F7',
            'title' => "Активистка, комсомолка и просто...",
            'title_2' => "Подзаголовок",
            'items' => array(
                array( 'image' => Configuration::$assets_url."/gallery/1.jpg", 'title' => 'В кольце', 'desc' => 'Завораживающее зрелище' ),
                array( 'image' => Configuration::$assets_url."/gallery/2.jpg", 'title' => 'У входа', 'desc' => 'На входе встречает она' ),
                array( 'image' => Configuration::$assets_url."/gallery/3.jpg", 'title' => 'Метание ножей', 'desc' => 'Опасный трюк с ножами' ),
                array( 'image' => Configuration::$assets_url."/gallery/4.jpg", 'title' => 'Обилечивание', 'desc' => 'У кассы снова прима' ),
                array( 'image' => Configuration::$assets_url."/gallery/5.jpg", 'title' => 'Форма №2', 'desc' => 'Голый торс' ),
                array( 'image' => Configuration::$assets_url."/gallery/6.jpg", 'title' => 'Прима и клоун', 'desc' => 'Номер с фокусами' ),  
                array( 'image' => Configuration::$assets_url."/gallery/7.jpg", 'title' => 'Ноги от ушей', 'desc' => 'От 16 и старше' ),
                array( 'image' => Configuration::$assets_url."/gallery/8.jpg", 'title' => 'В гримёрке', 'desc' => 'Перед выходом на сцену' ),
                array( 'image' => Configuration::$assets_url."/gallery/9.jpg", 'title' => 'Качели', 'desc' => 'Прима под куполом' ), 
            )
        ];
    }
    
     
	function tpl_6($val) {?>		
        <div class="container-fluid gallery gallery_6" style="background: <?=$val['background']?>;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <? if ($cls = $this->vis($val['show_title'])): ?>
                            <h1 class="title <?=$cls?> " >
                                <? $this->sub('Text','title',Text::$plain_heading) ?>
                            </h1>
                        <? endif ?>
                        <? if ($cls = $this->vis($val['show_title_2'])): ?>
                            <div class="title_2 <?=$cls?> " >
                                <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                            </div>
                        <? endif ?>
                        <? (!$val['show_image_title'] && !$val['show_image_desc']) ? $opacity ='no_opacity': $opacity ='' ?>
                        <div class="item_list masonry <?=$opacity?>" data-masonry-gutter="15">
                            <? $this->repeat('items', function($item_val,$self) use ($val){ ?>
                                <div class="preview_img">									
                                    <img src="<?=$self->api->base_url."/".$item_val['image']?>">
                                    <? if ($cls = $self->vis($val['enable_fancybox'])): ?>
                                        <a class="fancybox big_img <?=$cls?>" href="<?=$self->api->base_url."/".$item_val['image']?>" title="<?=$item_val['title']?>"></a>
                                    <? endif ?> 
                                </div>
                                <div class="overlay">
                                    <div class="outer">
                                        <div class="wrap_title_desc">
                                            <? if ($cls = $self->vis($val['show_image_title'])): ?>
                                                <div class="img_title <?=$cls?>" >
                                                    <?= $item_val['title'] ?>
                                                </div>
                                            <? endif ?>
                                            <? if ($cls = $self->vis($val['show_image_desc'])): ?>
                                                <div class="img_desc <?=$cls?>" >
                                                    <?= $item_val['desc'] ?>
                                                </div>
                                            <? endif ?>
                                        </div>
                                    </div>
                                </div>
                            <? },array('editor'=>'lp.galleryRepeater','sortable'=>false));?> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function item_default_6($url) {
        return self::$en ? [
            'image' => Configuration::$assets_url."/gallery/".$url,
            'title' => 'Title',
            'desc' => 'Description',
        ] : [
            'image' => Configuration::$assets_url."/gallery/".$url,
            'title' => 'Заголовок картинки',
            'desc' => 'Описание картинки',
        ];
    }
    
    function tpl_default_6() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
            'show_image_title' => true,
            'show_image_desc' => true,
			'enable_fancybox' => true,
            'background' =>'#FFFFFF',
            'title' => "Our program in photos",
            'title_2' => "Subtitle",
            'items' => array(
                array( 'image' => Configuration::$assets_url."/gallery/11.jpg", 'title' => 'Clown Zhora', 'desc' => 'Play-actor №1' ),
                array( 'image' => Configuration::$assets_url."/gallery/12.jpg", 'title' => 'Jugglers', 'desc' => 'Funny boys' ),
                array( 'image' => Configuration::$assets_url."/gallery/13.jpg", 'title' => 'Clown John', 'desc' => 'Funny hocus-pocus' ),
                array( 'image' => Configuration::$assets_url."/gallery/14.jpg", 'title' => 'Soaring', 'desc' => 'Two in the air' ),
                array( 'image' => Configuration::$assets_url."/gallery/15.jpg", 'title' => 'Figure', 'desc' => 'Girls under the big top' ),
                array( 'image' => Configuration::$assets_url."/gallery/16.jpg", 'title' => 'Python and Zhora', 'desc' => 'Dangerous performance' ),  
                array( 'image' => Configuration::$assets_url."/gallery/17.jpg", 'title' => 'Hippo with a ball', 'desc' => 'Woman with ball' ), 
            )
        ] : [
            'show_title' => true,
            'show_title_2' => false,
            'show_image_title' => true,
            'show_image_desc' => true,
			'enable_fancybox' => true,
            'background' =>'#FFFFFF',
            'title' => "Фото цирковых номеров",
            'title_2' => "Подзаголовок",
            'items' => array(
                array( 'image' => Configuration::$assets_url."/gallery/11.jpg", 'title' => 'Клоун Жора', 'desc' => 'Смехун цирка №1' ),
                array( 'image' => Configuration::$assets_url."/gallery/12.jpg", 'title' => 'Жонглёры', 'desc' => 'Весёлые ребята' ),
                array( 'image' => Configuration::$assets_url."/gallery/13.jpg", 'title' => 'Клоун Клёва', 'desc' => 'Весёлые фокусы-покусы' ),
                array( 'image' => Configuration::$assets_url."/gallery/14.jpg", 'title' => 'Парящие', 'desc' => 'Пара в воздухе' ),
                array( 'image' => Configuration::$assets_url."/gallery/15.jpg", 'title' => 'Фигура', 'desc' => 'Девушки под куполом цирка' ),
                array( 'image' => Configuration::$assets_url."/gallery/16.jpg", 'title' => 'Питон и Жора', 'desc' => 'Опасный номер' ),  
                array( 'image' => Configuration::$assets_url."/gallery/17.jpg", 'title' => 'Бегемотица с шаром', 'desc' => 'Капибара и женщина с шаром' ), 
            )
        ];
    }
	
    
function tpl_7($val) {?>
        <div class="container-fluid gallery gallery_7" style="background: <?=$val['background']?>;">           
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <? if ($cls = $this->vis($val['show_title'])): ?>
                            <h1 class="title <?=$cls?> " >
                                <? $this->sub('Text','title',Text::$plain_heading) ?>
                            </h1>
                        <? endif ?>
                        <? if ($cls = $this->vis($val['show_title_2'])): ?>
                            <div class="title_2 <?=$cls?> " >
                                <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                            </div>
                        <? endif ?>
                        <? (!$val['show_image_title'] && !$val['show_image_desc']) ? $opacity ='no_opacity': $opacity ='' ?>
                        <div class="item_list <?=$opacity?>">
                            <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                                <div class="img_double"> 
                                    <div class="img">
                                        <? $self->sub('OverlayImage','image_1') ?>	
                                    </div>
                                </div>
                                <div class="img_side">
                                    <? for ($i=2; $i <= 5; $i++): ?>
                                        <div class="img">
                                            <? $self->sub('OverlayImage','image_'.$i) ?>
                                        </div>	
                                    <? endfor ?>
                                </div>
                            <? }) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_7() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_title' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Gallery circus",
            'title_2' => "Subtitle",
            'items' => array(
                array(
					'image_1' => array('image'=> Configuration::$assets_url.'/gallery/30.jpg', 'title' => 'Grace', 'desc' => 'Girl on the tape'),
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/22.jpg', 'title' => 'Kite Bob', 'desc' => 'Bob is sitting on a barrel'),
                    'image_3' => array('image'=> Configuration::$assets_url.'/gallery/21.jpg', 'title' => 'Three people put the hats on', 'desc' => 'Acrobats on the ropes'),
                    'image_4' => array('image'=> Configuration::$assets_url.'/gallery/25.jpg', 'title' => 'Jumper', 'desc' => 'Show with the horse'),
                    'image_5' => array('image'=> Configuration::$assets_url.'/gallery/28.jpg', 'title' => 'Live time', 'desc' => 'Girls imitate watches'),
                )
            )
        ] : [
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_title' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Галерея цирковых номеров",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
					'image_1' => array('image'=> Configuration::$assets_url.'/gallery/30.jpg', 'title' => 'Грация', 'desc' => 'Девушка на лентах'),
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/22.jpg', 'title' => 'Коршун Веня', 'desc' => 'Веня сидит на бочке'),
                    'image_3' => array('image'=> Configuration::$assets_url.'/gallery/21.jpg', 'title' => 'Трое в шляпах', 'desc' => 'Акробаты на канатах'),
                    'image_4' => array('image'=> Configuration::$assets_url.'/gallery/25.jpg', 'title' => 'Прыгун', 'desc' => 'Номер с конём'),
                    'image_5' => array('image'=> Configuration::$assets_url.'/gallery/28.jpg', 'title' => 'Живое время', 'desc' => 'Девушки имитируют часы'),
                )
            )
        ];
    }
    
    
    function tpl_8($val) {?>
        <div class="container-fluid gallery gallery_8" style="background: <?=$val['background']?>;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <? if ($cls = $this->vis($val['show_title'])): ?>
                            <h1 class="title <?=$cls?> " >
                                <? $this->sub('Text','title',Text::$plain_heading) ?>
                            </h1>
                        <? endif ?>
                        <? if ($cls = $this->vis($val['show_title_2'])): ?>
                            <div class="title_2 <?=$cls?> " >
                                <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                            </div>
                        <? endif ?>
                        <? (!$val['show_image_title'] && !$val['show_image_desc']) ? $opacity ='no_opacity': $opacity ='' ?>
                        <div class="item_list clear <?=$opacity?>">
                            <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                                <div class="img_side">
                                    <div class="img img_h2">
                                        <? $self->sub('OverlayImage','image_1') ?> 
                                    </div>
                                    <div class="img">
                                        <? $self->sub('OverlayImage','image_2') ?> 
                                    </div>
                                </div>
                                <div class="img_double">
                                    <div class="img img_w2">
                                        <? $self->sub('OverlayImage','image_3') ?> 
                                    </div>
                                    <div class="img">
                                        <? $self->sub('OverlayImage','image_4') ?> 
                                    </div>
                                    <div class="img">
                                        <? $self->sub('OverlayImage','image_5') ?>
                                    </div>
                                    <div class="img img_w2">
                                        <? $self->sub('OverlayImage','image_6') ?>
                                    </div>                                
                                </div>                            
                                <div style="clear: both"></div>
                            <? }) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_8() {  
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_title' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Photos of our work",
			'title_2' => "Subtitle",
            'items' => array(
                array(
                    'image_1' => array('image'=> Configuration::$assets_url.'/gallery/25.jpg', 'title' => 'Jumper', 'desc' => 'Show with the horse'),
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/26.jpg', 'title' => 'Lambada', 'desc' => 'Dancing elephants'),
                    'image_3' => array('image'=> Configuration::$assets_url.'/gallery/30.jpg', 'title' => 'Grace', 'desc' => 'The girl on the tape'),
                    'image_4' => array('image'=> Configuration::$assets_url.'/gallery/24.jpg', 'title' => 'Tusk', 'desc' => 'Trained rhino'),
                    'image_5' => array('image'=> Configuration::$assets_url.'/gallery/21.jpg', 'title' => 'Three people put the hats on', 'desc' => 'Acrobats on the ropes'),
					'image_6' => array('image'=> Configuration::$assets_url.'/gallery/27.jpg', 'title' => 'Tigress', 'desc' => 'It is the one on the left'),
				) 
            )
        ] : [
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_title' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Фото нашей работы",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'image_1' => array('image'=> Configuration::$assets_url.'/gallery/25.jpg', 'title' => 'Прыгун', 'desc' => 'Номер с конём'),
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/26.jpg', 'title' => 'Ламбада', 'desc' => 'Танцующие слоны'),
                    'image_3' => array('image'=> Configuration::$assets_url.'/gallery/30.jpg', 'title' => 'Грация', 'desc' => 'Девушка на лентах'),
                    'image_4' => array('image'=> Configuration::$assets_url.'/gallery/24.jpg', 'title' => 'Бивень', 'desc' => 'Дрессированный носорог'),
                    'image_5' => array('image'=> Configuration::$assets_url.'/gallery/21.jpg', 'title' => 'Трое в шляпах', 'desc' => 'Акробаты на канатах'),
					'image_6' => array('image'=> Configuration::$assets_url.'/gallery/27.jpg', 'title' => 'Тигрица', 'desc' => 'Это та, что слева'),
				) 
            )
        ];
    }
    
    
    function tpl_9($val) {?>
        <div class="container-fluid gallery gallery_9" style="background: <?=$val['background']?>;">           
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <? if ($cls = $this->vis($val['show_title'])): ?>
                            <h1 class="title <?=$cls?> " >
                                <? $this->sub('Text','title',Text::$plain_heading) ?>
                            </h1>
                        <? endif ?>
                        <? if ($cls = $this->vis($val['show_title_2'])): ?>
                            <div class="title_2 <?=$cls?> " >
                                <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                            </div>
                        <? endif ?>
                        <? (!$val['show_image_title'] && !$val['show_image_desc']) ? $opacity ='no_opacity': $opacity ='' ?>
                        <div class="item_list clear <?=$opacity?>">
                            <? $this->repeat('items',function($item_val,$self) use ($val) { ?>                    
                                <div class="img_double">
                                    <div class="img">
                                        <? $self->sub('OverlayImage','image_1') ?>
                                    </div>
                                </div>
                                <div class="img_side">
                                    <div>
                                        <div class="img img_w2">
                                            <? $self->sub('OverlayImage','image_2') ?>
                                        </div>
                                        <div class="img">
                                            <? $self->sub('OverlayImage','image_3') ?>
                                        </div>
                                        <div class="img">
                                            <? $self->sub('OverlayImage','image_4') ?>
                                        </div>  
                                    </div>                                  
                                </div>
                                <div class="img_left_bottom">
                                    <div class="img img_w2">
                                        <? $self->sub('OverlayImage','image_5') ?>
                                    </div>
                                </div>
                                <div class="img_right_bottom">
                                    <div class="img img_w3">
                                        <? $self->sub('OverlayImage','image_6') ?>
                                    </div>
                                </div>
                            <? }) ?>
                        </div>      
                    </div>              
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_9() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_title' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Gallery circus performances",
			'title_2' => "Subtitle",
            'items' => array(
                array(
                    'image_1' => array('image'=> Configuration::$assets_url.'/gallery/23.jpg', 'title' => 'Leapfrog', 'desc' => 'People in blue trousers'),
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/28.jpg', 'title' => 'Live time', 'desc' => 'Girls imitate watches'),
                    'image_3' => array('image'=> Configuration::$assets_url.'/gallery/29.jpg', 'title' => 'Moon', 'desc' => 'Flying people on the moon'),
                    'image_4' => array('image'=> Configuration::$assets_url.'/gallery/30.jpg', 'title' => 'Grace', 'desc' => 'The girl on the tape'),
                    'image_5' => array('image'=> Configuration::$assets_url.'/gallery/21.jpg', 'title' => 'Three people put the hats on', 'desc' => 'Acrobats on the ropes'),
					'image_6' => array('image'=> Configuration::$assets_url.'/gallery/22.jpg', 'title' => 'Kite Bob', 'desc' => 'Bob is sitting on a barrel'),
				)
            )
        ] : [
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_title' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Галерея цирковых выступлений",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'image_1' => array('image'=> Configuration::$assets_url.'/gallery/23.jpg', 'title' => 'Чехарда', 'desc' => 'Люди в синих трениках'),
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/28.jpg', 'title' => 'Живое время', 'desc' => 'Девушки имитируют часы'),
                    'image_3' => array('image'=> Configuration::$assets_url.'/gallery/29.jpg', 'title' => 'Лунтики', 'desc' => 'Полёт людей на луну'),
                    'image_4' => array('image'=> Configuration::$assets_url.'/gallery/30.jpg', 'title' => 'Грация', 'desc' => 'Девушка на лентах'),
                    'image_5' => array('image'=> Configuration::$assets_url.'/gallery/21.jpg', 'title' => 'Трое в шляпах', 'desc' => 'Акробаты на канатах'),
					'image_6' => array('image'=> Configuration::$assets_url.'/gallery/22.jpg', 'title' => 'Коршун Веня', 'desc' => 'Веня сидит на бочке'),
				)                
            )
        ];
    }
    
    
    function tpl_10($val) {?>
        <div class="container-fluid gallery gallery_10" style="background: <?=$val['background']?>;">           
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <? if ($cls = $this->vis($val['show_title'])): ?>
                            <h1 class="title <?=$cls?> " >
                                <? $this->sub('Text','title',Text::$plain_heading) ?>
                            </h1>
                        <? endif ?>
                        <? if ($cls = $this->vis($val['show_title_2'])): ?>
                            <div class="title_2 <?=$cls?> " >
                                <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                            </div>
                        <? endif ?>
                        <? (!$val['show_image_title'] && !$val['show_image_desc']) ? $opacity ='no_opacity': $opacity ='' ?>
                        <div class="item_list clear <?=$opacity?>">
                            <? $this->repeat('items',function($item_val,$self) use ($val) { ?>                    
                                <div class="img_side">
                                    <div class="img img_w1 img_h2">
                                        <? $self->sub('OverlayImage','image_1') ?>
                                    </div>
                                </div>
                                <div class="img_double">
                                    <div class="img img_w2">
                                    <? $self->sub('OverlayImage','image_2') ?>
                                    </div>
                                    <div class="img">
                                        <? $self->sub('OverlayImage','image_3') ?>
                                    </div>
                                    <div class="img">
                                        <? $self->sub('OverlayImage','image_4') ?>
                                    </div>
                                    <div class="img img_w2">
                                        <? $self->sub('OverlayImage','image_5') ?>
                                    </div>
                                </div>
                            <? }) ?>
                        </div>    
                    </div>                
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_10() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_title' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Gallery",
			'title_2' => "Subtitle",
            'items' => array(
                array(
                    'image_1' => array('image'=> Configuration::$assets_url.'/gallery/21.jpg', 'title' => 'Three people put the hats on', 'desc' => 'Acrobats on the ropes'),
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/22.jpg', 'title' => 'Kite Bob', 'desc' => 'Bob is sitting on a barrel'),
                    'image_3' => array('image'=> Configuration::$assets_url.'/gallery/23.jpg', 'title' => 'Leapfrog', 'desc' => 'People in blue trousers'),
                    'image_4' => array('image'=> Configuration::$assets_url.'/gallery/24.jpg', 'title' => 'Tusk', 'desc' => 'Trained rhino'),
                    'image_5' => array('image'=> Configuration::$assets_url.'/gallery/25.jpg', 'title' => 'Jumper', 'desc' => 'Show with the horse'),
					'image_6' => array('image'=> Configuration::$assets_url.'/gallery/26.jpg', 'title' => 'Lambada', 'desc' => 'Dancing elephants'),
				)
            )
        ] : [
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_title' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Галерея",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'image_1' => array('image'=> Configuration::$assets_url.'/gallery/21.jpg', 'title' => 'Трое в шляпах', 'desc' => 'Акробаты на канатах'),
                    'image_2' => array('image'=> Configuration::$assets_url.'/gallery/22.jpg', 'title' => 'Коршун Веня', 'desc' => 'Веня сидит на бочке'),
                    'image_3' => array('image'=> Configuration::$assets_url.'/gallery/23.jpg', 'title' => 'Чехарда', 'desc' => 'Люди в синих трениках'),
                    'image_4' => array('image'=> Configuration::$assets_url.'/gallery/24.jpg', 'title' => 'Бивень', 'desc' => 'Дрессированный носорог'),
                    'image_5' => array('image'=> Configuration::$assets_url.'/gallery/25.jpg', 'title' => 'Прыгун', 'desc' => 'Номер с конём'),
					'image_6' => array('image'=> Configuration::$assets_url.'/gallery/26.jpg', 'title' => 'Ламбада', 'desc' => 'Танцующие слоны'),
				)
            ) 
        ];
    }
}