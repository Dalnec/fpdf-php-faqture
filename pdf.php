<?php
require('fpdf/fpdf.php');
require('model.php');
$month = $_POST['month'];
$year = $_POST['year'];

function SetTotal(float $valor):string
{
	return number_format($valor,2,'.','');
}
function cantidad_Final($entrada, $salida){
	$cant_final = $entrada - $salida;
	return $cant_final;
}

class pdf extends FPDF
{	
	public function header(){
		//obteniendo de model
		$faqture = new Faqture();
		$empresa = $faqture->getEmpresa();
		$local = $faqture->getLocal();
		$producto = $faqture->getProducto();	
		//Encabezado 
		$this->SetFillColor(253, 135,39);
		$this->Rect(0,0, 297, 20, 'F');
		$this->SetY(3);
		$this->SetFont('Arial', 'B', 8);
		$this->SetTextColor(255,255,255);
		$this->Cell(0, 2, 'REGISTRO DE INVENTARIO PERMANENTE VALORIZADO - DETALLE DEL INVENTARIO VALORIZADO', 0,0,'C');
		
		$this->Ln(5);		
		$this->SetFont('Courier', 'B', 8);
		//Descripcion en el encabezado
		$this->Cell(90, 3, 'Periodo: Algun Mes', 0, 0);
		$this->Cell(90, 3, 'Código de la Existencia: Almacenar??', 0, 0);		
		$this->Cell(90, 3, 'Método de Valuación: PROMEDIO PONDERADO MÓVIL', 0, 1);		
		$this->Cell(90, 3, 'R.U.C. : '.$empresa->number, 0, 0);
		$this->Cell(90, 3, 'Tipo: 01 '.$producto->unit_type_id,0,1);		
		$this->Cell(90, 3, 'Razon Social: '.$empresa->trade_name, 0, 0);
		$this->Cell(90, 3, 'Descripción: '.$producto->description, 0, 1);
		$this->Cell(90, 3, 'Establecimiento: '.$local->address, 0, 0);
		$this->Cell(90, 3, 'Unidad de Medida: 01', 0, 1);
		$this->ln(2);
		//Primer encabezado de la tabla
		$this->SetFont('Courier', 'B', 10);
		$this->SetTextColor(80,80,80);
		$this->Cell(25, 2, 'Fecha',0,0, 'C');
		$this->Cell(68, 2, 'Documento de la Operación',0,0, 'C');
		$this->Cell(68, 2, 'Entradas',0,0, 'C');
		$this->Cell(68, 2, 'Salidas',0,0, 'C');
		$this->Cell(68, 2, 'Saldo Final',0,0, 'C');
		$this->SetTextColor(177,34,78);
		$this->ln(3);
		//segundo encabezado de la tabla
		$this->SetFillColor(255,255,255);
		$this->SetLineWidth(1);
		$this->SetDrawColor(177,34,78);
		$this->SetTextColor(177,34,78);
		$this->SetFont('Courier', 'B', 8);
		//Documento de la operacion Sobra 2
		$this->Cell(15, 5, '', 'T', 0, 'C', 0);
		$this->Cell(10, 5, 'Tipo', 'T', 0, 'C', 0);
		$this->Cell(28, 5, 'Serie', 'T', 0, 'C', 0);
		$this->Cell(28, 5, 'Número', 'T', 0, 'C', 0);
		//Entradas
		$this->Cell(14, 5, 'Cantidad', 'T', 0, 'C', 0);
		$this->Cell(28, 5, 'Costo Unitario', 'T', 0, 'C', 0);
		$this->Cell(28, 5, 'Costo Total', 'T', 0, 'C', 0);
		//Salidas
		$this->Cell(14, 5, 'Cantidad', 'T', 0, 'C', 0);
		$this->Cell(28, 5, 'Costo Unitario', 'T', 0, 'C', 0);
		$this->Cell(28, 5, 'Costo Total', 'T', 0, 'C', 0);
		//Saldo Final
		$this->Cell(14, 5, 'Cantidad', 'T', 0, 'C', 0);
		$this->Cell(28, 5, 'Costo Unitario', 'T', 0, 'C', 0);
		$this->Cell(28, 5, 'Costo Total', 'T', 0, 'C', 0);
		$this->ln(4);				
	}

	public function footer()
	{	//paginacion pie de pagina
		$this->SetY(-10);
		$this->SetFont('Arial', 'I', 7);
		$this->AliasNbPages();
		$this->Cell(0,6, 'Página '.$this->PageNo().'/{nb}',0,1,'C');
		$this->Cell(0,0, date("Y-m-d"),0,0,'C');
	}
}
//formato de pagina horizontal, milimetros, tamaño, utf8
$fpdf = new pdf('L','mm','A4',true);
//establece el titulo de la vista de impresion
$fpdf->SetTitle('REGISTRO DE INVENTARIO PERMANENTE VALORIZADO');

$fpdf->SetMargins(5,5,5,5);
$fpdf->AddPage();
//cuerpo de la tabla
$fpdf->ln(5);

//obteniendo de model
$faqture = new Faqture();
$id = 2;
$datos = $faqture->getDatos($id, $month, $year);

//Cuerpo de la tabla obtiene de BD
$fpdf->SetLineWidth(0.5);
$fpdf->SetTextColor(0,0,0);
$fpdf->SetFillColor(255,255,255);
$fpdf->SetDrawColor(80,80,80);
$fpdf->SetFont('Courier', 'B', 7);

//Saldo Inicial
$fpdf->Cell(15, 3, 'Saldo Inicial', '', 0, 'C', 0);
$fpdf->Cell(10, 3, '', '', 0, 'C', 0);
$fpdf->Cell(28, 3, '', '', 0, 'C', 0);
$fpdf->Cell(28, 3, '', '', 0, 'C', 0);
$fpdf->Cell(14, 3, '', '', 0, 'C', 0);
$fpdf->Cell(28, 3, '', '', 0, 'C', 0);
$fpdf->Cell(28, 3, '', '', 0, 'C', 0);
$fpdf->Cell(14, 3, '', '', 0, 'C', 0);
$fpdf->Cell(28, 3, '', '', 0, 'C', 0);
$fpdf->Cell(28, 3, '', '', 0, 'C', 0);
$fpdf->Cell(14, 3, '', '', 0, 'C', 0);
$fpdf->Cell(28, 3, '', '', 0, 'C', 0);
$fpdf->Cell(28, 3, '', '', 0, 'C', 0);

$cantEntrada = 0;
$cantSalida = 0;
foreach($datos as $dato)
{
	//listado de datos desde la BD
	$fpdf->Cell(15, 3, $dato->fecha, '', 0, 'C', 0);
	$fpdf->Cell(10, 3, $dato->tipo, '', 0, 'C', 0);
	$fpdf->Cell(28, 3, $dato->series, '', 0, 'C', 0);
	$fpdf->Cell(28, 3, $dato->numbers, '', 0, 'C', 0);
	//Entradas
	$fpdf->Cell(14, 3, round($dato->cant_entrada,2), '', 0, 'C', 0);
	$fpdf->Cell(28, 3, round($dato->precio_unit,2), '', 0, 'C', 0);
	$fpdf->Cell(28, 3, round($dato->cant_entrada * $dato->precio_unit,2), '', 0, 'C', 0);
	$cantEntrada = $cantEntrada + round($dato->cant_entrada,2);
	//Salidas
	$fpdf->Cell(14, 3, round($dato->cant_salida,2), '', 0, 'C', 0);
	$fpdf->Cell(28, 3, round($dato->precio_unit_salida,2), '', 0, 'C', 0);
	$fpdf->Cell(28, 3, round($dato->cant_salida * $dato->precio_unit_salida,2), '', 0, 'C', 0);
	$cantSalida = $cantSalida + round($dato->cant_salida,2);
	//Saldo Final
	$fpdf->Cell(14, 3, cantidad_Final($cantEntrada, $cantSalida), '', 0,'C', 0);
	$fpdf->Cell(28, 3, '', '', 0, 'C', 0);
	$fpdf->Cell(28, 3, '', '', 0, 'C', 0);
	$fpdf->ln(3);
}

//muestra la pagina y estable el nombre del archivo a descargar
$fpdf->OutPut('Reg.Inventario_Permanente_Valorizado_'.date("Y-m-d").'.pdf', 'I');