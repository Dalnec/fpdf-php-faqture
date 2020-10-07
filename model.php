<?php 
require_once('db.php'); 

class Faqture extends Database
{
	public function getDatos($idproducto, $month, $year){
		$query = $this->pdo->query("SELECT K.id id,
		case when K.type = 'purchase' then (select P.date_of_issue from faqture_avejhoisa.purchases P where P.id = K.purchase_id)
			else K.date_of_issue
		end fecha,
		K.type,
		case when K.type = 'purchase' then (select P.document_type_id from faqture_avejhoisa.purchases P where P.id = K.purchase_id)
			else (select D.document_type_id from faqture_avejhoisa.documents D where D.id = K.document_id)
		end tipo,
		K.item_id,
		case when K.document_id is not null then (select D.series from faqture_avejhoisa.documents D where D.id = K.document_id) 
			when K.purchase_id is not null then (select P.series from faqture_avejhoisa.purchases P where P.id = K.purchase_id) 
			when K.sale_note_id is not null then (select S.series from faqture_avejhoisa.sale_notes S where S.id = K.sale_note_id)
			else ''
		end series,
		case when K.document_id is not null then (select D.number from faqture_avejhoisa.documents D where D.id = K.document_id) 
			when K.purchase_id is not null then (select P.number from faqture_avejhoisa.purchases P where P.id = K.purchase_id) 
			when K.sale_note_id is not null then (select S.number from faqture_avejhoisa.sale_notes S where S.id = K.sale_note_id)
			else ''
		end numbers,
		case when K.type = 'purchase' then K.quantity
			else ''
		end cant_entrada,
		case when K.type = 'purchase' then (select unit_price from faqture_avejhoisa.purchase_items PI where PI.purchase_id = K.purchase_id)
			else ''
		end precio_unit,
		case when K.type != 'purchase' then K.quantity
			else ''
		end cant_salida,
		case when K.type = 'sale' then (select DI.unit_price from faqture_avejhoisa.document_items DI where DI.document_id = K.document_id)
			else ''
		end precio_unit_salida,
		K.created_at,
		K.updated_at
		FROM faqture_avejhoisa.items I
		INNER JOIN faqture_avejhoisa.kardex K ON K.item_id = I.id
		WHERE I.id = " .$idproducto. " AND month(K.date_of_issue) = ".$month." AND year(K.date_of_issue) = ".$year."
		ORDER BY fecha");
		return $query->fetchAll();
	}
	public function getEmpresa(){
		$query = $this->pdo->query("SELECT * FROM faqture_avejhoisa.companies");
		return $query->fetch();
	}
	
	public function getProducto(){
		$query = $this->pdo->query("SELECT * FROM faqture_avejhoisa.items WHERE id = 2");
		return $query->fetch();
	}
	
	public function getLocal(){
		$query = $this->pdo->query("SELECT * FROM faqture_avejhoisa.establishments");
		return $query->fetch();
	}
}