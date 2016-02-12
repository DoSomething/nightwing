<table id="redirects-table" class="table">
	<thead>
		<tr class="row table-header">
			<th class="table-cell">Incoming path</th>
			<th class="table-cell">Target URL</th>
			<th class="table-cell">HTTP Status</th>
		</tr>
	</thead>
	<tbody>
		@forelse($redirects as $redirect)
			<tr class="table-row">
				<td class="table-cell">{{ $redirect->path }}</a></td>
				<td class="table-cell">{{ $redirect->target}}</td>
				<td class="table-cell">{{ $redirect->http_status }}</td>
			</tr>
		@empty
		@endforelse
	</tbody>
</table>
