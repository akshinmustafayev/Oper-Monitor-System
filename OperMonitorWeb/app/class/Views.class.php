<?php
	class Views
	{
		public function AddView($view_piece, $params = array())
		{
			$language = New Lang();
			$lang = array();
			$lang = $language->GetLangArray();
			$login = new Login();
			
			include('app/views/'.$view_piece);
		}
	}
?>