<html>

	@include('template.head')


	<body>

		@include('template.navigation')

		<div class="content">

			<div class="table-products-container">
				<div class="filter-products">
					<form class="filter-products-form">
						<b>Weight</b>
						<select>
							<option value="1">1</option>
						</select>
					</form>
				</div>
				<table class="table-products">
					<thead>
						<tr>
							<th class="cell-shrink cell-center">ID</th>
							<th>Name</th>
							<th class="cell-shrink cell-center">Code</th>
							<th class="cell-shrink cell-center">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($products as $product) : ?>
							<tr>
								<td class="cell-shrink cell-center">{{ $product->id }}</td>
								<td>{{ $product->name }}</td>
								<td class="cell-shrink cell-center">{{ $product->code }}</td>
								<td class="cell-shrink cell-center">
									<a href="/products/edit?item={{ $product->id }}" alt="Edit Item">Edit</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

		</div>

		@include('template.footer')
		

	</body>

</html>