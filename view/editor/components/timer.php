<?php

class Timer extends Block {
    public $name = 'Таймер';
    public $description = "Счетчик для акции";
    public $editor = "lp.timer";    
  
    function tpl($val) {?>
        <div class="container-fluid timer timer_1" style="background:<?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title',Text::$plain_text) ?>
                    </h1>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                    <div class="countdown_desc">
                        <? $this->sub('Text','countdown_desc',Text::$plain_text) ?>
                    </div>
					<div class="countdown_wrap" style="color:<?=$val['countdown_color']?>;">
						<? $this->sub('Countdown', 'countdown') ?>
					</div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return  array(
            'show_title_2' => true,			
            'background_color' => '#FFFFFF',
            'countdown_color' => '#E76953',
            'title' => 'Семинар пройдет 20 декабря 2015г. в 12:00',
            'title_2' => 'Количество мест ограничено, успейте оплатить участие',
            'countdown_desc' => 'До начала мероприятия осталось:',  
            'countdown' => array_merge(Countdown::tpl_default(),
                   array('type' => 'daily','date' => date("Y/m/d"),'dayOfWeek' => 0 ,'day' => 5,'time' => '23:55')),
        );
    }
    
    function tpl_2($val) {?>
        <div class="container-fluid timer timer_2" style="<?=$this->bg_style($val['background'])?>">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title',Text::$plain_text) ?>
                    </h1>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?= $val['title_2_color'] ? $val['title_2_color'] : "" ?> <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                    <div class="countdown_desc">
                        <? $this->sub('Text','countdown_desc',Text::$plain_text) ?>
                    </div>
                    <div class="countdown_wrap <?= $val['title_2_color'] ? $val['title_2_color'] : "" ?>">
						<? $this->sub('Countdown','countdown') ?>
					</div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_2() { 
        return  array(
            'show_title_2' => true,
            'title_2_color' => 'timer_red',
            'background' => array('url'=>'view/editor/assets/texture_black/1.jpg'),
            'title' => 'Семинар пройдет 20 декабря 2015г. в 12:00',
            'title_2' => 'Количество мест ограничено, успейте оплатить участие',
            'countdown_desc' => 'До начала мероприятия осталось:',
            'countdown' => array_merge(Countdown::tpl_default(),array('type' => 'daily','date' => date("Y/m/d"),'dayOfWeek' => 0,'day' => 5,'time' => '23:55')),
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid timer timer_3" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="span8">
                    <h1 class="title">
                        <? $this->sub('Text','title',Text::$plain_text) ?>
                    </h1>
                    <div class="timer_desc">
                        <? $this->sub('Text','timer_desc',Text::$plain_text) ?>
                    </div>
                    <div class="countdown_wrap">
						<? $this->sub('Countdown','countdown') ?>
					</div>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                </div>
                <div class="span8">
                    <div class="form">
                        <div class="form_title">
                            <? $this->sub('Text','form_title_1',Text::$default_text) ?>    
                        </div>
                        <div class="form_data">
                            <? $this->sub('FormOrder','form') ?>
                        </div>
                        <? if ($cls = $this->vis($val['show_form_bottom_text'])): ?>
							<div class="form_bottom <?=$cls?>" >
								<? $this->sub('Text','form_bottom_text',Text::$default_text) ?>
							</div>
						<? endif ?>                
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_3() { 
        return  array(
			'show_title_2' => true,
			'show_form_bottom_text' => true,
            'background_color' => '#FFFFFF',
            'title' => '<div>Семинар пройдет</div><div>20 декабря 2015г. в 12:00</div>',
            'title_2' => '<div>Количество мест ограничено,</div><div>успейте оплатить участие</div>',
            'timer_desc' => 'До начала мероприятия осталось:',
            'form_title_1' => "Заявка на участие",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию третьим лицам",
            'form' => array(
                'fields' => array(
                    array(
                        'label' => 'Имя:', 'sub_label' => '', 'required' => true,
                        'name' => 'name', 'type' => 'text', 
                    ),
                    array(
                        'label' => 'Телефон:', 'sub_label' => '', 'required' => true,
                        'name' => 'phone', 'type' => 'text', 
                    )
                ),
                'button' => array('color'=>'blue','label'=>'Отправить заявку'),
                'form_done_title' => 'Спасибо за заявку',
                'form_done_text' => 'Заявка отправлена. Наш менеджер свяжется с Вами в ближайшее время. ',
            ),
			'countdown' => array_merge(Countdown::tpl_default(),array('type' => 'daily','date' => date("Y/m/d"),'dayOfWeek' => 0,'day' => 5,'time' => '23:55')),
        );
    }
    
    
    function tpl_4($val) {?>
        <div class="container-fluid timer timer_4" style="<?=$this->bg_style($val['background'])?>">
            <div class="container">
                <div class="span8">
                    <h1 class="title">
                        <? $this->sub('Text','title',Text::$plain_text) ?>
                    </h1>
                    <div class="timer_desc">
                        <? $this->sub('Text','timer_desc',Text::$plain_text) ?>
                    </div>
                    <div class="countdown_wrap">
						<? $this->sub('Countdown','countdown') ?>
					</div>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                </div>
                <div class="span8">
                    <div class="form">
                        <div class="form_title">
                            <? $this->sub('Text','form_title_1',Text::$default_text) ?>    
                        </div>
                        <div class="form_data">
                            <? $this->sub('FormOrder','form') ?>
                        </div>
                        <? if ($cls = $this->vis($val['show_form_bottom_text'])): ?>
							<div class="form_bottom <?=$cls?>" >
								<? $this->sub('Text','form_bottom_text',Text::$default_text) ?>
							</div>
						<? endif ?>                
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_4() { 
        return  array(
            'show_title_2' => true,
			'show_form_bottom_text' => true,
			'background' => array('url'=>'view/editor/assets/texture_black/1.jpg'),
            'title' => '<div>Семинар пройдет</div><div>20 декабря 2015г. в 12:00</div>',
            'title_2' => '<div>Количество мест ограничено,</div><div>успейте оплатить участие</div>',
            'timer_desc' => 'До начала мероприятия осталось:',
            'form_title_1' => "Заявка на участие",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию третьим лицам",
            'form' => array(
                'fields' => array(
                    array(
                        'label' => 'Имя:', 'sub_label' => '', 'required' => true,
                        'name' => 'name', 'type' => 'text', 
                    ),
                    array(
                        'label' => 'Телефон:', 'sub_label' => '', 'required' => true,
                        'name' => 'phone', 'type' => 'text', 
                    )
                ),
                'button' => array('color'=>'blue','label'=>'Отправить заявку'),
                'form_done_title' => 'Спасибо за заявку',
                'form_done_text' => 'Заявка отправлена. Наш менеджер свяжется с Вами в ближайшее время. ',
            ),
			'countdown' => array_merge(Countdown::tpl_default(),array('type' => 'daily','date' => date("Y/m/d"),'dayOfWeek' => 0,'day' => 5,'time' => '23:55')),
        );
    }        
}

Timer::register();