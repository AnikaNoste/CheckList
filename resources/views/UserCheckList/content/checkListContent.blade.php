@if($statusList==1)
	&#9989;
@endif
<table >
  <thead>
	<tr>
	  <td style="width:30%;"> ID: {{ $listId }}</td>
	  <td>{{ $titleList }}</td>
	</tr>
  </thead>
  <tbody>
	@for($i=0;$i<count($id);$i++)
		@if($statusItem[$i]==1)
		<tr style="background:#BCEE68;">
		@else
		<tr style=" background:#FFDAB9;">
		@endif
		<td>{{ $id[$i] }}</td>
		<td>{{ $text[$i] }}</td>
	@endfor
	</tr>
  </tbody>
</table>
<td>{{ $_SESSION['error'] }}</td>
{{ $_SESSION['error'] = ''}}
<td>{{ $_SESSION['message'] }}</td>
{{ $_SESSION['message'] = ''}}
