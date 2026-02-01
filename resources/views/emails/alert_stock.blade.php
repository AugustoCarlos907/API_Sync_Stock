<!-- resources/views/emails/alert_stock.blade.php -->

<h2>Alerta de Produtos com Preço Baixo</h2>

<p>Os seguintes produtos estão com quantidade abaixo do limite definido:</p>

<table border="1" cellpadding="5" cellspacing="0">
	<thead>
		<tr>
			<th>Produto</th>
			<th>SKU</th>
			<th>Preço</th>
			<th>Quantidade</th>
		</tr>
	</thead>
	<tbody>
		@foreach($items as $item)
			<tr>
				<td>{{ $item->item_name }}</td>
				<td>{{ $item->sku }}</td>
				<td>{{ number_format($item->price, 2) }}</td>
				<td>{{ $item->quantity }}</td>
			</tr>
		@endforeach
	</tbody>
</table>
