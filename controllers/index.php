<?php
// контролер
Class Controller_Index Extends Controller_Base {    
    // шаблон
    public $layouts = "first_layouts";
     
    // экшен
    function index() 
	{   
        $res = null;
        $errors = null;
        $session = new Session();
		$session->start();
		$moderator = false;
		if(!$this->auth->Guest){$moderator = true;}
		
        // виводимо перелік країн 
        $select = array('order' => 'title ASC');
        $country = new Model_Countriescodes($select); // створюємо обєкт моделі
        $getCountry = $country->getAllRows(); // отримуємо всі знячення 
        //-----------------------------------
        // для пагінації підключаємось зо таблиці і дізнаємось к-ть записів
        $getComplaint = new Model_Complaints(array('where' => 'id > 0')); 
        $countComplaint = count($getComplaint->getAllRows()); // получаем все строки
        // створюємо об'єкт пагінації і передаємо :
        // кількість необхідних записів на сторінці // всього записів // кількість пагігацій
        $pagination = new Pagination_Base(5,$countComplaint,'',10);
        // отримаємо пагінацію
        $pag = $pagination->getPaginator();
        
        // запит до таблиці з пігінацією
        $sql = array(
            'order' => 'adddate DESC', // сортируем
            'limit' => $pagination->getLimit() // задаем лимит
        );
        $getComplaint = new Model_Complaints($sql); // создаем объект модели
        $listComplaint = $getComplaint->getAllRows(); // получаем все строки
       
        // Перевірка форм / додати новий запис
        $form = new Model_ComplainForm();
        if($form->errorPost('my'))
		{
            // создаем объект для запису в базу
            $addComplaint = new Model_Complaints();
            // задаем значения для полей таблицы
            $addComplaint->username = $form->entries['username']; 
            $addComplaint->email = $form->entries['email'];
            $addComplaint->site = $form->entries['site'];
            $addComplaint->country = $form->entries['country'];
            $addComplaint->complaint = $form->entries['complaint'];
            $addComplaint->browser = Messages::getBrowser();
            $addComplaint->ipaddress = Messages::getIp();
            $result = $addComplaint->save(); // создаем запись
            
            if($result === true){
                $res[] = "Запис успішно доданий";
				$session->set('create',serialize($res));
				$this->refresh();
				
            }else{
                $res[] = "Запис не додано по невідомим причинам";
				$session->set('errorForm',serialize($res));
				$this->refresh();
            }
        }else{
            $errors=$form->errors;
			if(count($errors)>0){
				$session->set('errorForm',serialize($errors));
				$this->refresh();
			}
        }
        
		// перевірка форм / редагувати запис
		$forms = new Model_ComplainForm();
		if($forms->errorPost('edit'))
		{
            
			if($forms->entries['param'] > 0){
				$id = $forms->entries['param'];
				$select = array('where' => 'id = "'.$id.'"'	);
			
				// создаем объект для запису в базу
				$editComplaint = new Model_Complaints($select);
				// извлекаем данные
				$editComplaint->fetchOne();
				// задаем новые значения
				$editComplaint->username = htmlspecialchars($forms->entries['username']); 
				$editComplaint->email = htmlspecialchars($forms->entries['email']); 
				$editComplaint->site = htmlspecialchars($forms->entries['site']); 
				$editComplaint->complaint = htmlspecialchars($forms->entries['complaint']); 

				// обновляем запись
				$result = $editComplaint->update();
				echo $result;
				if($result > 0){
					$resedit[] = "Запис успішно змінено";
					$session->set('edits',serialize($resedit));
					$this->refresh();

				}else{
					$resedit[] = "Запис не змінено по невідомим причинам";
					$session->set('errorEdits',serialize($resedit));
					$this->refresh();
				}
			}else{
				$resedit[] = "Запис не змінено не апипустиме id";
				$session->set('errorEdits',serialize($resedit));
				$this->refresh();
			}
        }else{
			if(count($forms->errors)>0){
				$session->set('errorFormEdits',serialize($forms->errors));
				$this->refresh();
			}
        }
		
        // Видалити запис
		if(isset($_POST['drop']) && $_POST['drop'] > 0){
			$drop = new Model_Complaints();
            $select = array('where' => 'id = "'.$_POST['drop'].'"');
			$result = $drop->deleteBySelect($select);
			if($result > 0){
                $r[] = "Запис успішно видалено";
				$session->set('del',serialize($r));
				$this->refresh();
				
            }else{
                $r[] = "Запис не видалено по невідомим причинам";
				$session->set('errors',serialize($r));
				$this->refresh();
            }
		}
        
        
        $this->template->vars('complaints', $listComplaint);
		$this->template->vars('moderator', $moderator);
        $this->template->vars('countrys', $getCountry);
        $this->template->vars('result', $res    );
        $this->template->vars('pagination', $pag);
        $this->template->vars('res', $res);
        $this->template->vars('title', 'Книга скарг');
        
        $this->template->view('index');
    }    
} 